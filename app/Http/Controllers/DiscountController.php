<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use App\Models\DiscountCategories;
use App\Models\Product;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil semua data diskon
        $discount = Discount::with('category', 'product')->get();

        return view('discount.index', compact('discount'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $discountcat = DiscountCategories::all();
        
        // Mendapatkan semua produk
        $products = Product::all();

        // Mengirimkan data kategori diskon dan produk ke view create
        return view('discount.create', compact('discountcat', 'products'));
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'category_discount_id' => 'required',
            'product_id' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'percentage' => 'required',
        ]);
    
        // Membuat diskon baru
        $discount = new Discount();
        $discount->category_discount_id = $request->category_discount_id;
        $discount->product_id = $request->product_id;
        $discount->start_date = $request->start_date;
        $discount->end_date = $request->end_date;
        $discount->percentage = $request->percentage;
        $discount->save();
    
        return redirect()->route('discount.index')->with('success', 'Discount created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Discount $discount)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $discount = Discount::findOrFail($id);
        $discountcat = DiscountCategories::all();
        $products = Product::all();

        return view('discount.edit', compact('discount', 'discountcat', 'products'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        //
        $request->validate([
            'category_discount_id' => 'required',
            'product_id' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'percentage' => 'required',
        ]);

        $discount = Discount::findOrFail($id);
        $discount->category_discount_id = $request->category_discount_id;
        $discount->product_id = $request->product_id;
        $discount->start_date = $request->start_date;
        $discount->end_date = $request->end_date;
        $discount->percentage = $request->percentage;
        $discount->save();

        return redirect()->route('discount.index')->with('success', 'Discount updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $discount = Discount::findOrFail($id);
        $discount->delete();

        return redirect()->route('discount.index')
                         ->with('success', 'Discount deleted successfully');
    }
}
