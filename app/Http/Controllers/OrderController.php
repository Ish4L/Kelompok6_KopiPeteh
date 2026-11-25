<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class OrderController extends Controller
{
    public function dashboardIndex()
    {
        $todayOrders = OrderItem::with(['product', 'order.items.product'])->whereDate('created_at', Carbon::today())->latest()->get();
        $todayCups = $todayOrders->sum('quantity');

        $weeklyOrderItems = OrderItem::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
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
        $todayCups = OrderItem::whereDate('created_at', Carbon::today())->sum('quantity');
        $requestCups = collect($request->products)->sum('quantity');

        if (($todayCups + $requestCups) > 10) {
            $cupsLeft = 10 - $todayCups;
            $message = $cupsLeft > 0
                ? "Maaf, kuota hari ini tersisa {$cupsLeft} cup."
                : "Maaf, kuota hari ini sudah penuh";

            return back()->withErrors(['error' => $message]);
        }
    
        return DB::transaction(function () use ($request) {
            $totalPrice = 0;
            $itemsData = [];

            foreach ($request->products as $item) {
                if ($item['quantity'] > 0) {
                    $product = Product::findOrFail($item['product_id']);
                    $quantity = $item['quantity'];
                    $price = $product->price;
                    
                    $totalPrice += ($quantity * $price);

                    $itemsData[] = [
                        'product_id' => $product->id,
                        'quantity' => $quantity,
                        'price' => $price,
                    ];
                }
            }

            $order = Order::create([
                'name' => $request->name,
                'phone' => $request->phone,
                'total_price' => $totalPrice,
                'status' => 'belum bayar',
            ]);

            foreach ($itemsData as $itemData) {
                $order->items()->create($itemData);
            }

            // return redirect()->route('order.index')->with('success', 'Pesanan berhasil dibuat.');
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

        return back()->with('success', 'Status pesanan berhasil diperbarui');
    }

    public function destroy(string $id)
    {
        //
    }
}
