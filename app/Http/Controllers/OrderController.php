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
                $query->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->where('status', '!=', 'dibatalkan');
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

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'           => 'required|string|max:255',
            'phone'          => 'required|string|max:20',
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

        DB::transaction(function () use ($validated, $cartItems, $requestedTotalCups) {
            $products = Product::lockForUpdate()->get()->keyBy('id');

            $soldToday = OrderItem::whereHas('order', function ($query) {
                $query->whereDate('created_at', today())
                      ->where('status', '!=', 'dibatalkan');
            })->sum('quantity');

            $remainingQuota = max(0, self::DAILY_MAX_CUPS - $soldToday);

            if ($requestedTotalCups > $remainingQuota) {
                $pesan = $remainingQuota === 0
                    ? 'Maaf, kuota pesanan hari ini sudah habis.'
                    : "Maaf, sisa kuota hari ini tersisa {$remainingQuota} cup (pesanan Anda {$requestedTotalCups} cup).";

                throw ValidationException::withMessages([
                    'quota' => $pesan,
                ]);
            }

            $totalPrice = 0;
            foreach ($cartItems as $item) {
                $product = $products->get($item['id']);

                if (!$product) {
                    throw ValidationException::withMessages([
                        'items' => 'Salah satu menu tidak ditemukan.',
                    ]);
                }

                $qty = (int) ($item['quantity'] ?? $item['qty']);
                $totalPrice += $product->price * $qty;
            }

            $order = Order::create([
                'name'           => $validated['name'],
                'phone'          => $validated['phone'],
                'payment_method' => $validated['payment_method'],
                'total_price'    => $totalPrice,
                'status'         => 'belum bayar',
            ]);

            foreach ($cartItems as $item) {
                $product = $products->get($item['id']);
                $qty = (int) ($item['quantity'] ?? $item['qty']);

                OrderItem::create([
                    'order_id'   => $order->id,
                    'product_id' => $product->id,
                    'variant'    => $item['variant'],
                    'quantity'   => $qty,
                    'price'      => $product->price,
                ]);
            }
        });

        return redirect()->route('menu')->with('order_success', 'Pesanan Anda berhasil dibuat!');
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

        return back()->with('success', 'Status pesanan berhasil diperbarui');
    }

    public function destroy(string $id)
    {
        //
    }
}
