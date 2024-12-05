<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Customer;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil semua data diskon
        $order = Order::with('customer')->get();

        return view('order.index', compact('order'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $customername = Customer::all();

        // Mengirimkan data kategori diskon dan produk ke view create
        return view('order.create', compact('customername'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'customer_id' => 'required',
            'order_date' => 'required',
            'total_amount' => 'required',
            'status' => 'required',
        ]);
    
        // Membuat diskon baru
        $order = new Order();
        $order->customer_id = $request->customer_id;
        $order->order_date = $request->order_date;
        $order->total_amount = $request->total_amount;
        $order->status = $request->status;
        $order->save();
    
        return redirect()->route('order.index')
                         ->with('success', 'order created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $order = Order::findOrFail($id);
        $customername = Customer::all();

        return view('order.edit', compact('order', 'customername'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        //
        $request->validate([
            'customer_id' => 'required',
            'order_date' => 'required',
            'total_amount' => 'required',
            'status' => 'required',
        ]);
    
        // Membuat diskon baru
        $order = Order::findOrFail($id);
        $order->customer_id = $request->customer_id;
        $order->order_date = $request->order_date;
        $order->total_amount = $request->total_amount;
        $order->status = $request->status;
        $order->save();
    
        return redirect()->route('order.index')
                         ->with('success', 'order created successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order,$id)
    {
        //
        $order = order::findOrFail($id);
        $order->delete();

        return redirect()->route('order.index')
                         ->with('success', 'order deleted successfully');
    }
}
