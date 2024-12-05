<?php

namespace App\Http\Controllers;

use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $orderdetail = OrderDetail::with('order', 'product')->get();

        return view('orderdetail.index', compact('orderdetail'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $orders = Order::all();
        
        // Mendapatkan semua produk
        $products = Product::all();

        // Mengirimkan data kategori diskon dan produk ke view create
        return view('orderdetail.create', compact('orders', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,)
    {
        //
        $request->validate([
            'product_id' => 'required',
            'order_id' => 'required',
            'quantity' => 'required',
            'subtotal' => 'required',
        ]);
    
        // Membuat diskon baru
        $orderdetail = new OrderDetail();
        $orderdetail->product_id = $request->product_id;
        $orderdetail->order_id = $request->order_id;
        $orderdetail->quantity = $request->quantity;
        $orderdetail->subtotal = $request->subtotal;
        $orderdetail->save();
    
        return redirect()->route('orderdetail.index')
                         ->with('success', 'orderdetail created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(OrderDetail $orderDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OrderDetail $orderDetail,$id)
    {
        //
        $orderdetail = OrderDetail::findOrFail($id);
        $orders = Order::all();
        $products = Product::all();

        return view('orderdetail.edit', compact('orderdetail', 'orders', 'products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        //
        $request->validate([
            'product_id' => 'required',
            'order_id' => 'required',
            'quantity' => 'required',
            'subtotal' => 'required',
        ]);
    
        // Membuat diskon baru
        $orderdetail = OrderDetail::findOrFail($id);
        $orderdetail->product_id = $request->product_id;
        $orderdetail->order_id = $request->order_id;
        $orderdetail->quantity = $request->quantity;
        $orderdetail->subtotal = $request->subtotal;
        $orderdetail->save();
    
        return redirect()->route('orderdetail.index')
                         ->with('success', 'orderdetail created successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OrderDetail $orderdetail,$id)
    {
        //
        $orderdetail = OrderDetail::findOrFail($id);
        $orderdetail->delete();

        return redirect()->route('orderdetail.index')
                         ->with('success', 'orderdetail deleted successfully');
    }
}
