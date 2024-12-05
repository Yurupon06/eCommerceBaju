<?php

namespace App\Http\Controllers;

use App\Models\DiscountCategories;
use Illuminate\Http\Request;

class DiscountCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('discountcat.index' ,[
            'discountcat' => DiscountCategories::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('discountcat.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $data = $request->only(['category_name',]);
        DiscountCategories::create($data);
        return redirect()->route('discountcat.index')->with([
            'status' => 'simpan',
            'pesan' => 'The new discountcat data with the name "' . $request->discountcat . '" has been created ',
            'discountcat' => DiscountCategories::all()
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(DiscountCategories $discountCategories)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $discountcat = DiscountCategories::find($id);
        if (!$discountcat)
            return redirect()->route('discountcat.index')->with('error_message', 'discountcat dengan id' . $id . 'tidak ditemukan');
        return view('discountcat.edit', [
            'discountcat' => $discountcat
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'category_name' => 'required',
        ]);
        $discountcat = DiscountCategories::find($id);
        $discountcat->category_name = $request->category_name;
        $discountcat->save();
        return redirect()->route('discountcat.index')
            ->with('success_message', 'Berhasil mengubah discount cat');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $discountcat = DiscountCategories::findOrFail($id);

        try {
            $discountcat->delete();
            return redirect()->route('discountcat.index')->with([
                'status' => 'success',
                'message' => 'The product category has been deleted successfully.',
            ]);
        } catch (\Exception $e) {
            return redirect()->route('discountcat.index')->with([
                'status' => 'error',
                'message' => 'Failed to delete the product category. Please try again later.',
            ]);
        }
    }
}
