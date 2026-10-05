<?php

namespace App\Http\Controllers;

use App\Models\Order_item;
use Illuminate\Http\Request;

class OrderItemController extends Controller
{
    public function index()
    {
        $orderItems = Order_item::all();
        return view('order_item.index', compact('orderItems'));
    }

    public function create()
    {
        return view('order_item.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0' 
        ]);

        Order_item::create($request->all());
        return redirect()->route('order_item.index')->with('success', 'Order item created successfully.');
    }

    public function show(Order_item $order_item)
    {
        //
    }

    public function edit(Order_item $order_item)
    {
        //
    }

    public function update(Request $request, Order_item $order_item)
    {
        //
    }

    public function destroy(string $id)
    {
        $orderItem = Order_item::findOrFail($id);
        $orderItem->delete();
        return redirect()->route('order_item.index')->with('success', 'Order item deleted successfully.');
    }
}
