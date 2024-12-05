<?php

namespace App\Http\Controllers;

use App\Models\Deliverie;
use App\Models\Order;
use Illuminate\Http\Request;

class DeliverieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //// Mengambil semua data diskon
        $deliverie = Deliverie::with('order')->get();

        return view('deliverie.index', compact('deliverie'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        // Mendapatkan semua produk
        $orders = Order::all();

        // Mengirimkan data kategori diskon dan produk ke view create
        return view('deliverie.create', compact('orders'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'order_id' => 'required',
            'shipping_date' => 'required',
            'tracking_code' => 'required',
            'status' => 'required',
            'foto_kurir' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        // Membuat diskon baru
        $deliverie = new Deliverie();
        $deliverie->order_id = $request->order_id;
        $deliverie->shipping_date = $request->shipping_date;
        $deliverie->tracking_code = $request->tracking_code;
        $deliverie->status = $request->status;
        if ($request->hasFile('foto_kurir')) {
            $deliverie['foto_kurir'] = $request->file('foto_kurir')->store('Foto_Kurir');
        }
        $deliverie->save();
    
        return redirect()->route('deliverie.index')
                         ->with('success', 'deliverie created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Deliverie $deliverie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $deliverie = Deliverie::findOrFail($id);
        $orders = Order::all();

        return view('deliverie.edit', compact('deliverie','orders'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Deliverie $deliverie)
    {
        $request->validate([
            'status' => 'required',
            'foto_kurir' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        $deliverie->status = $request->status;
    
        if ($request->hasFile('foto_kurir')) {
            $deliverie->foto_kurir = $request->file('foto_kurir')->store('foto_kurir', 'public');
        }
    
        $deliverie->save();
    
        return redirect()->route('deliverie.index')
                         ->with('success', 'Deliverie updated successfully.');
    }
    
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Deliverie $deliverie)
    {
        //
    }
}
