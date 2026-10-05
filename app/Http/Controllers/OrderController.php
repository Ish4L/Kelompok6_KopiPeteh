<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::all();
        return view('admin.history', compact('orders'));
    }

    public function create()
    {
        return view('order.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'phone' => 'required|string|max:20',
            'total_price' => 'required|numeric|min:0',
            'status' => 'required|in:pending,processing,completed,cancelled'
        ]);

        Order::create($request->all());
        return redirect()->route('order.index')->with('success', 'Order created successfully.');
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
