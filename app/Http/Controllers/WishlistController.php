<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use App\Models\Product;
use App\Models\Customer;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $wishlist = Wishlist::with('customer', 'product')->get();
        return view('wishlist.index', compact('wishlist'));;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $customers = Customer::all();
        
        // Mendapatkan semua produk
        $products = Product::all();

        // Mengirimkan data kategori diskon dan produk ke view create
        return view('wishlist.create', compact('customers', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'customer_id' => 'required',
            'product_id' => 'required',
        ]);
    
        
        $wishlist = new Wishlist();
        $wishlist->customer_id = $request->customer_id;
        $wishlist->product_id = $request->product_id;
        $wishlist->save();
    
        return redirect()->route('wishlist.index')
                         ->with('success', 'wishlist created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Wishlist $wishlist)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Wishlist $wishlist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Wishlist $wishlist)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Wishlist $wishlist)
    {
        //
    }
}
