<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;

class CustomerRegisterController extends Controller
{
    //
    public function showRegisterForm()
    {
        return view('auth.customer-register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:customers',
            'password' => 'required|string|min:3|confirmed',
            'phone' => 'required|string|max:20',
            'alamat1' => 'required|string',
        ]);

        $customer = Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'phone' => $request->phone,
            'alamat1' => $request->alamat1,
            'alamat2' => $request->alamat2,
            'alamat3' => $request->alamat3,
        ]);

        Auth::guard('customer')->login($customer);

        return redirect()->route('landing.index');
    }
    
}
