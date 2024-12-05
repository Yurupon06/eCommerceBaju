<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('customer.index' ,[
            'customer' => Customer::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('customer.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:customers',
            'password' => 'required|string|min:3|confirmed',
            'phone' => 'required|string|max:15',
            'alamat1' => 'required|string|max:255',
            'alamat2' => 'nullable|string|max:255',
            'alamat3' => 'nullable|string|max:255',
        ]);

        $customer = new Customer();
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->password = bcrypt($request->password);
        $customer->phone = $request->phone;
        $customer->alamat1 = $request->alamat1;
        $customer->alamat2 = $request->alamat2;
        $customer->alamat3 = $request->alamat3;
        $customer->save();

        return redirect()->route('customer.index')->with('status', 'Customer added successfully!');

    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $customer = Customer::findOrFail($id);
        return view('customer.edit', compact('customer'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:customers,email,'.$id,
            'phone' => 'required|string|max:15',
            'alamat1' => 'required|string|max:255',
            'alamat2' => 'nullable|string|max:255',
            'alamat3' => 'nullable|string|max:255',
        ]);

        $customer = Customer::findOrFail($id);
        $customer->name = $request->name;
        $customer->email = $request->email;
        if ($request->password) {
            $customer->password = bcrypt($request->password);
        }
        $customer->phone = $request->phone;
        $customer->alamat1 = $request->alamat1;
        $customer->alamat2 = $request->alamat2;
        $customer->alamat3 = $request->alamat3;
        $customer->save();

        return redirect()->route('customer.index')->with('status', 'Customer updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $customer = Customer::findOrFail($id);

        try {
            $customer->delete();
            return redirect()->route('customer.index')->with([
                'status' => 'success',
                'message' => 'The product category has been deleted successfully.',
            ]);
        } catch (\Exception $e) {
            return redirect()->route('customer.index')->with([
                'status' => 'error',
                'message' => 'Failed to delete the product category. Please try again later.',
            ]);
        }
    }
}
