<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('product.index', [
            'product' => DB::table('vwproduct')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('product.create', [
            'category_name' => ProductCategories::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $mn = DB::table('products')->where('product_name', '=', $request->product_name)->value('product_name');
        if ($mn) {
            return view('product.edit', [
                'status' => 'duplicate',
                'category_name' => ProductCategories::all(),
                'product_name' => $request->product_name,
                'category_name' => $request->category_name,
                'description' => $request->description
            ]);
        } else {
            $data = $request->only(['product_category_id', 'category_name', 'product_name', 'description', 'price', 'stok_quantity']);

            // Simpan gambar ke direktori storage/Products
            if ($request->hasFile('image1_url')) {
                $data['image1_url'] = $request->file('image1_url')->store('Products');
            }
            if ($request->hasFile('image2_url')) {
                $data['image2_url'] = $request->file('image2_url')->store('Products');
            }
            if ($request->hasFile('image3_url')) {
                $data['image3_url'] = $request->file('image3_url')->store('Products');
            }

            $simpan = Product::create($data);
            return redirect()->route('product.index')->with([
                'status' => 'simpan',
                'pesan' => 'New product data with the name "' . $request->product_name . '" has been successfully added.',
                'product_name' => DB::table('vwproduct')->get()
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
{
    //
    $product = Product::findOrFail($id);
    return view('product.edit', compact('product'));
}

/**
 * Update the specified resource in storage.
 */
public function update(Request $request, $id)
{
    //
    $product = Product::findOrFail($id);

    $request->validate([
        'product_name' => 'required',
        'description' => 'required',
        'price' => 'required|numeric',
        'image1_url' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        'image2_url' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        'image3_url' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $data = $request->only(['product_category_id', 'product_name', 'description', 'price']);
    $data['image1_url'] = $product->image1_url;
    $data['image2_url'] = $product->image2_url;
    $data['image3_url'] = $product->image3_url;

    if ($request->hasFile('image1_url')) {
        $data['image1_url'] = $request->file('image1_url')->store('Products');
    }
    if ($request->hasFile('image2_url')) {
        $data['image2_url'] = $request->file('image2_url')->store('Products');
    }
    if ($request->hasFile('image3_url')) {
        $data['image3_url'] = $request->file('image3_url')->store('Products');
    }

    $product->update($data);

    return redirect()->route('product.index')->with([
        'status' => 'success',
        'message' => 'The product has been updated successfully.',
    ]);
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        if ($product) {
            // Delete images first before deleting the product
            $images = [
                $product->image1_url,
                $product->image2_url,
                $product->image3_url
            ];
    
            $hapus = $product->delete();
            if ($hapus) {
                foreach ($images as $image) {
                    if ($image && file_exists(public_path("storage/" . $image))) {
                        unlink(public_path("storage/" . $image));
                    }
                }
            }
    
            return redirect()->route('product.index')
                ->with('success_message', 'Berhasil menghapus produk "' . $product->product_name . '"!');
        }
    
        return redirect()->route('product.index')
            ->with('error_message', 'Produk tidak ditemukan!');
    }
    
}