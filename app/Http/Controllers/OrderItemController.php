<?php

namespace App\Http\Controllers;

use App\Models\Order_item;
use Illuminate\Http\Request;

class OrderItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orderItems = Order_item::all();
        return view('order_item.index', compact('orderItems'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('order_item.create');
    }

    /**
     * Store a newly created resource in storage.
     */
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

    /**
     * Display the specified resource.
     */
    public function show(Order_item $order_item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order_item $order_item)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order_item $order_item)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $orderItem = Order_item::findOrFail($id);
        $orderItem->delete();
        return redirect()->route('order_item.index')->with('success', 'Order item deleted successfully.');
    }
}
