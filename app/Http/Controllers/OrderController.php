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
        $todayOrders = OrderItem::with('order', 'product')->whereDate('created_at', Carbon::today())->get();
        $todayCups = $todayOrders->sum('quantity');

        $weekOrderItems = OrderItem::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
        $weekCups = $weekOrderItems->sum('quantity');
        $weekIncome = $weekOrderItems->sum(function ($item) {
            return $item->quantity * $item->price;
        });

        return view('admin.dashboard', compact('todayOrders', 'todayCups', 'weekCups', 'weekIncome'));
    }
    
    public function historyIndex()
    {
        $orders = Order::with('items.product')->latest()->get();
        return view('admin.history', compact('orders'));
    }

    public function create()
    {
        return view('order.create');
    }

    public function store(Request $request)
    {
        $todayCups = OrderItem::whereDate('created_at', Carbon::today())->sum('quantity');
        $requestCups = collect($request->products)->sum('quantity');

        if (($todayCups + $requestCups) > 10) {
            $cupsLeft = 10 - $todayCups;
            $message = $cupsLeft > 0
                ? "Maaf, kuota hari ini sisa {$cupsLeft} cup."
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
                'status' => 'pending',
            ]);

            foreach ($itemsData as $itemData) {
                $order->items()->create($itemData);
            }

            return redirect()->route('order.index')->with('success', 'Pesanan berhasil dibuat.');
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
        //
    }

    public function destroy(string $id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
        return redirect()->route('order.index')->with('success', 'Order deleted successfully.');
    }
}
