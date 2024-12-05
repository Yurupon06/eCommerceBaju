<?php

namespace App\Http\Controllers;

use App\Models\ProductCategories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ProductCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('productcategories.index',[
            'productcategories' => ProductCategories::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('productcategories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required|unique:product_categories,category_name',
        ]);
    
        // Attempt to create a new category
        try {
            $category = ProductCategories::create([
                'category_name' => $request->category_name,
            ]);
    
            return redirect()->route('productcategories.index')->with([
                'status' => 'success',
                'message' => 'The new product category with the name "' . $category->category_name . '" has been created.',
            ]);
        } catch (\Exception $e) {
            // Handle any exceptions, such as database errors
            return redirect()->route('productcategories.index')->with([
                'status' => 'error',
                'message' => 'Failed to create the product category. Please try again later.',
            ]);
        }
    }
    

    /**
     * Display the specified resource.
     */
    public function show(ProductCategories $productCategories)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //get post by ID
        $category = ProductCategories::findOrFail($id);

        //render view with post
        return view('productcategories.edit', compact('category'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'category_name' => 'required|string|max:255',
        ]);

        $category = ProductCategories::find($id);

        $category->update($request->all());

        return redirect()->route('productcategories.index')->with('success', 'Product category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category = ProductCategories::findOrFail($id);

    try {
        $category->delete();
        return redirect()->route('productcategories.index')->with([
            'status' => 'success',
            'message' => 'The product category has been deleted successfully.',
        ]);
    } catch (\Exception $e) {
        return redirect()->route('productcategories.index')->with([
            'status' => 'error',
            'message' => 'Failed to delete the product category. Please try again later.',
        ]);
    }
    }
}
