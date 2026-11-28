<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;

class OrderController extends Controller
{
    private const DAILY_MAX_CUPS = 10;

    public function dashboardIndex()
    {
        $todayOrders = OrderItem::with(['product', 'order.items.product'])->whereHas('order', 
            function ($query) {
                $query->whereDate('created_at', Carbon::today())->where('status', '!=', 'dibatalkan');
            }
        )->latest()->get();

        $todayCups = $todayOrders->sum('quantity');

        $weeklyOrderItems = OrderItem::whereHas('order', 
            function ($query) {
                $query->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->where('status', 'selesai');
            }
        )->get();

        $weeklyCups = $weeklyOrderItems->sum('quantity');
        $weeklyIncome = $weeklyOrderItems->sum(function ($item) {
            return $item->quantity * $item->price;
        });

        return view('admin.dashboard', compact('todayOrders', 'todayCups', 'weeklyCups', 'weeklyIncome'));
    }

    public function orderIndex(Request $request)
    {
        $orders = Order::with('items.product')->when($request->status, 
            function ($query, $status) {
                $query->where('status', $status);
            })->when($request->search, 
                function ($query, $search) {
                    $query->where(
                        function ($q) use ($search) {
                            $q->where('id', 'like', "%{$search}%")->orWhere('name', 'like', "%{$search}%");
                        }
                    );
                }
            )->latest()->paginate(6)->withQueryString();

    return view('admin.order', compact('orders'));
    }

    public function landingIndex()
    {
        $soldToday = OrderItem::whereHas('order', 
            function ($query) {
                $query->whereDate('created_at', today())->where('status', '!=', 'dibatalkan');
            }
        )->sum('quantity');

        if ($soldToday >= self::DAILY_MAX_CUPS) {
            return redirect()->route('unavailable');
        }

        return view('user.available');
    }

    public function unavailableIndex()
    {
        $soldToday = OrderItem::whereHas('order', 
            function ($query) {
                $query->whereDate('created_at', today())->where('status', '!=', 'dibatalkan');
            }
        )->sum('quantity');

        if ($soldToday < self::DAILY_MAX_CUPS) {
            return redirect()->route('available');
        }

        return view('user.unavailable');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'           => 'required|string|max:255',
            'phone'          => 'required|string|regex:/^[0-9]+$/|min:10|max:15',
            'payment_method' => 'required|in:cash,QRIS',
            'items'          => 'required|string',
        ]);

        $cartItems = json_decode($validated['items'], true);

        if (!is_array($cartItems) || count($cartItems) === 0) {
            return back()->withErrors(['items' => 'Keranjang pesanan tidak boleh kosong.']);
        }

        $requestedTotalCups = 0;
        foreach ($cartItems as $item) {
            $quantity = (int) ($item['quantity'] ?? $item['qty'] ?? 0);
            if ($quantity < 1) {
                return back()->withErrors(['items' => 'Jumlah item tidak valid.']);
            }
            $requestedTotalCups += $quantity;
        }

        if ($requestedTotalCups > self::DAILY_MAX_CUPS) {
            return back()->withErrors([
                'quota' => 'Maksimal pemesanan adalah ' . self::DAILY_MAX_CUPS . ' cup per hari.',
            ]);
        }

        $products = Product::whereIn('id', collect($cartItems)->pluck('id'))->get()->keyBy('id');
        $totalPrice = 0;
        $normalizedItems = [];

        foreach ($cartItems as $item) {
            $product = $products->get($item['id']);
            if (!$product) {
                return back()->withErrors(['items' => 'Salah satu menu tidak ditemukan.']);
            }

            $qty = (int) ($item['quantity'] ?? $item['qty']);
            $totalPrice += $product->price * $qty;

            $normalizedItems[] = [
                'product_id' => $product->id,
                'variant'    => $item['variant'],
                'quantity'   => $qty,
                'price'      => $product->price,
            ];
        }

        if ($validated['payment_method'] === 'QRIS') {
            $soldToday = OrderItem::whereHas('order', 
                function ($query) {
                    $query->whereDate('created_at', today())->where('status', '!=', 'dibatalkan');
                }
            )->sum('quantity');

            $remainingQuota = max(0, self::DAILY_MAX_CUPS - $soldToday);

            if ($requestedTotalCups > $remainingQuota) {
                $pesan = $remainingQuota === 0
                    ? 'Maaf, kuota pesanan hari ini sudah habis.'
                    : "Maaf, kuota hari ini tersisa {$remainingQuota} cup (pesanan Anda {$requestedTotalCups} cup).";

                return back()->withErrors(['quota' => $pesan]);
            }

            session([
                'pending_qris_order' => [
                    'name'           => $validated['name'],
                    'phone'          => $validated['phone'],
                    'payment_method' => 'QRIS',
                    'total_price'    => $totalPrice,
                    'total_cups'     => $requestedTotalCups,
                    'items'          => $normalizedItems,
                    'confirmable_at' => now()->addSeconds(30)->timestamp,
                ],
            ]);

            return redirect()->route('payment.qris');
        }

        $order = $this->createOrderWithQuotaLock([
            'name'           => $validated['name'],
            'phone'          => $validated['phone'],
            'payment_method' => 'cash',
            'total_price'    => $totalPrice,
            'total_cups'     => $requestedTotalCups,
            'items'          => $normalizedItems,
        ], 'belum bayar');

        session(['completed_order_id' => $order->id]);

        return redirect()->route('detail')->with([
            'clear_cart' => true,
            'success'    => 'Pesanan berhasil dibuat',
        ]);
    }

    public function qrisPayment()
    {
        $pendingOrder = session('pending_qris_order');

        if (!$pendingOrder) {
            return redirect()->route('cart')->withErrors(['items' => 'Sesi pembayaran QRIS tidak ditemukan atau sudah kedaluwarsa.']);
        }

        $remainingSeconds = max(0, ($pendingOrder['confirmable_at'] ?? 0) - now()->timestamp);

        return view('user.qris', compact('pendingOrder', 'remainingSeconds'));
    }

    public function confirmQris()
    {
        $pendingOrder = session('pending_qris_order');

        if (!$pendingOrder) {
            return redirect()->route('cart')->withErrors(['items' => 'Sesi pembayaran QRIS tidak ditemukan.']);
        }

        if (now()->timestamp < ($pendingOrder['confirmable_at'] ?? 0)) {
            return back()->withErrors(['qris' => 'Silakan tunggu hingga waktu hitung mundur 30 detik selesai.']);
        }

        try {
            $order = $this->createOrderWithQuotaLock($pendingOrder, 'menunggu');
        } catch (ValidationException $e) {
            session()->forget('pending_qris_order');
            return redirect()->route('cart')->withErrors($e->errors());
        }

        session()->forget('pending_qris_order');
        session(['completed_order_id' => $order->id]);

        return redirect()->route('detail')->with([
            'clear_cart' => true,
            'success'    => 'Pesanan berhasil dibuat',
        ]);
    }

    public function detailOrder()
    {
        $orderId = session('completed_order_id');
        $order = $orderId ? Order::with('items.product')->find($orderId) : null;

        if (!$order) {
            return redirect()->route('menu');
        }

        return view('user.detail-order', compact('order'));
    }

    private function createOrderWithQuotaLock(array $orderData, string $status): Order
    {
        return DB::transaction(function () use ($orderData, $status) {
            Product::lockForUpdate()->get();

            $soldToday = OrderItem::whereHas('order', 
                function ($query) {
                    $query->whereDate('created_at', today())->where('status', '!=', 'dibatalkan');
                }
            )->sum('quantity');

            $remainingQuota = max(0, self::DAILY_MAX_CUPS - $soldToday);

            if ($orderData['total_cups'] > $remainingQuota) {
                $pesan = $remainingQuota === 0
                    ? 'Maaf, kuota pesanan hari ini sudah habis.'
                    : "Maaf, sisa kuota hari ini tersisa {$remainingQuota} cup (pesanan Anda {$orderData['total_cups']} cup).";

                throw ValidationException::withMessages([
                    'quota' => $pesan,
                ]);
            }

            $order = Order::create([
                'name'           => $orderData['name'],
                'phone'          => $orderData['phone'],
                'payment_method' => $orderData['payment_method'],
                'total_price'    => $orderData['total_price'],
                'status'         => $status,
            ]);

            foreach ($orderData['items'] as $item) {
                OrderItem::create([
                    'order_id'   => $order->id,
                    'product_id' => $item['product_id'],
                    'variant'    => $item['variant'],
                    'quantity'   => $item['quantity'],
                    'price'      => $item['price'],
                ]);
            }

            return $order;
        });
    }

    public function show(Order $order)
    {
        //
    }

    public function edit(Order $order)
    {
        //
    }

    public function update(Request $request, Order $order)
    {
        if (!in_array($order->status, ['belum bayar', 'menunggu'])) {
            return back()->with('error', 'Status pesanan yang sudah selesai atau dibatalkan tidak dapat diubah');
        }

        $request->validate([
            'status' => 'required|in:belum bayar,menunggu,selesai,dibatalkan',
        ]);

        $order->update([
            'status' => $request->status,
        ]);

        return back()->with('success', 'Status pesanan berhasil diubah');
    }

    public function destroy(string $id)
    {
        //
    }
}
