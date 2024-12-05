<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategories;
use App\Models\Wishlist;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Customer;
use App\Models\Deliverie;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class LandingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Lakukan apapun yang perlu dilakukan untuk halaman landing

        // Kembalikan view landing.index
        return view('landing.index');
    }

    public function shop()
    {
        // Ambil data produk dari database
        $products = Product::with('discount')->get();
        $categories = ProductCategories::all();

        // Kembalikan view shop.blade.php dengan data produk
        return view('landing.shop', compact('products', 'categories'));
    }

    public function profile()
    {
        $customer = Auth::guard('customer')->user();
    
        if (!$customer) {
            return redirect()->route('customer.login')->with('error', 'You must be logged in to view your profile.');
        }
    
        return view('landing.profile', compact('customer'));
    }

    public function shopdetail(Request $request,$id)
    {
        // Ambil data produk dari database
        $products = Product::with('discount')->findOrFail($id);

        // Kembalikan view shop.blade.php dengan data produk
        return view('landing.shopdetail', compact('products'));
    }

// CART
    public function cart()
    {
        $customer = Auth::guard('customer')->user();
    
        if (!$customer) {
            return redirect()->route('customer.login')->with('error', 'You must be logged in to view your cart.');
        }
    
        $wishlistItems = Wishlist::where('customer_id', $customer->id)->with('product.discount')->get();
        return view('landing.cart', compact('wishlistItems'));
    }
    
    

    public function addToWishlist(Request $request, $productId)
    {
        $customer = Auth::guard('customer')->user();

        if (!$customer) {
            return redirect()->route('customer.login')->with('error', 'You must be logged in to add items to the wishlist.');
        }

        $product = Product::findOrFail($productId);

        $quantity = $request->input('quantity', 1); // Get the quantity from the request, default to 1 if not set

        $existingWishlistItem = Wishlist::where('customer_id', $customer->id)
                                        ->where('product_id', $productId)
                                        ->first();

        if ($existingWishlistItem) {
            // Update the quantity if the item already exists in the wishlist
            $existingWishlistItem->quantity += $quantity;
            $existingWishlistItem->save();
        } else {
            // Create a new wishlist item
            Wishlist::create([
                'customer_id' => $customer->id,
                'product_id' => $productId,
                'quantity' => $quantity,
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Product added to wishlist.');
    }

    public function updateCartQuantities(Request $request)
    {
        $customer = Auth::guard('customer')->user();

        if (!$customer) {
            return redirect()->route('customer.login')->with('error', 'You must be logged in to update the cart.');
        }

        $quantities = $request->input('quantities', []);

        foreach ($quantities as $wishlistId => $quantity) {
            $wishlistItem = Wishlist::where('id', $wishlistId)->where('customer_id', $customer->id)->first();
            if ($wishlistItem) {
                if ($quantity == 0) {
                    $wishlistItem->delete();
                } else {
                    $wishlistItem->update(['quantity' => $quantity]);
                }
            }
        }

        return redirect()->route('cart.index')->with('success', 'Cart updated successfully.');
    }

    public function updateAddress(Request $request)
    {
        $customer = Auth::guard('customer')->user();
    
        if (!$customer) {
            return redirect()->route('customer.login')->with('error', 'You must be logged in to update your address.');
        }
    
        $request->validate([
            'alamat1' => 'required|string|max:255',
        ]);
    
        // Explicitly fetch the customer as an Eloquent model if needed
        $customer = Customer::find($customer->id);
    
        // Ensure the customer is found and is an instance of the Customer model
        if ($customer instanceof Customer) {
            $customer->update([
                'alamat1' => $request->input('alamat1'),
            ]);
    
            return redirect()->route('cart.index')->with('success', 'Address updated successfully.');
        } else {
            return redirect()->route('cart.index')->with('error', 'Unable to update address.');
        }
    }
    public function updateAddressProfile(Request $request)
    {
        $customer = Auth::guard('customer')->user();
    
        if (!$customer) {
            return redirect()->route('customer.login')->with('error', 'You must be logged in to update your address.');
        }
    
        $request->validate([
            'alamat1' => 'required|string|max:255',
        ]);
    
        // Explicitly fetch the customer as an Eloquent model if needed
        $customer = Customer::find($customer->id);
    
        // Ensure the customer is found and is an instance of the Customer model
        if ($customer instanceof Customer) {
            $customer->update([
                'alamat1' => $request->input('alamat1'),
            ]);
    
            return redirect()->route('profile.index')->with('success', 'Address updated successfully.');
        } else {
            return redirect()->route('profile.index')->with('error', 'Unable to update address.');
        }
    }
    
    
    



//  END CART






public function checkout($orderId)
{
    $customer = Auth::guard('customer')->user();

    if (!$customer) {
        return redirect()->route('customer.login')->with('error', 'You must be logged in to view your cart.');
    }

    $order = Order::where('customer_id', $customer->id)->findOrFail($orderId);
    $wishlistItems = OrderDetail::where('order_id', $orderId)->with('product')->get();

    return view('landing.checkout', compact('order', 'wishlistItems'));
}



public function checkoutProcess(Request $request)
{
    Log::info('checkoutProcess method called.');

    $customer = Auth::guard('customer')->user();

    if (!$customer) {
        Log::error('User not authenticated.');
        return redirect()->route('customer.login')->with('error', 'You must be logged in to proceed with checkout.');
    }

    Log::info('Authenticated user: ', ['user' => $customer]);

    $wishlistItems = Wishlist::where('customer_id', $customer->id)->with('product')->get();

    if ($wishlistItems->isEmpty()) {
        Log::warning('Cart is empty for user: ', ['user' => $customer]);
        return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
    }

    Log::info('Wishlist items: ', ['items' => $wishlistItems]);

    // Calculate total amount
    $totalAmount = $wishlistItems->sum(function ($item) {
        return $item->product->discount 
            ? ($item->product->price * (1 - $item->product->discount->percentage / 100) * $item->quantity)
            : $item->product->price * $item->quantity;
    });

    // Create new order
    $order = Order::create([
        'customer_id' => $customer->id,
        'order_date' => now(),
        'total_amount' => $totalAmount,
        'status' => 'unpaid', // You can change this based on your requirements
    ]);

    Log::info('Order created: ', ['order' => $order]);

    // Create order details
    foreach ($wishlistItems as $item) {
        OrderDetail::create([
            'order_id' => $order->id,
            'product_id' => $item->product->id,
            'quantity' => $item->quantity,
            'subtotal' => $item->product->discount
                ? ($item->product->price * (1 - $item->product->discount->percentage / 100) * $item->quantity)
                : $item->product->price * $item->quantity,
        ]);
    }

    Log::info('Order details created for order ID: ', ['order_id' => $order->id]);

    // Clear wishlist after creating order
    Wishlist::where('customer_id', $customer->id)->delete();

    Log::info('Wishlist cleared for user: ', ['user' => $customer]);

    return redirect()->route('yourorder.index', $order->id)->with('success', 'Proceed to checkout.');
}



public function payNow($orderId)
{
    $customer = Auth::guard('customer')->user();

    if (!$customer) {
        return redirect()->route('customer.login')->with('error', 'You must be logged in to make a payment.');
    }

    $order = Order::where('customer_id', $customer->id)->findOrFail($orderId);
    $order->update(['status' => 'paid']);

    $shipping_date = Carbon::now()->addDays(5);
    
    // Mengisi model Deliverie
    $deliverie = new Deliverie();
    $deliverie->order_id = $order->id;
    $deliverie->shipping_date = $shipping_date;
    $deliverie->tracking_code = strval(rand(1000000000, 9999999999)); // Kode pelacakan 10 angka random
    $deliverie->status = 'being processed'; // Status pengiriman bisa disesuaikan
    $deliverie->save();
    
    // Mengisi model Payment
    $payment = new Payment();
    $payment->order_id = $order->id;
    $payment->payment_date = now(); // Tanggal pembayaran
    $payment->amount = $order->total_amount; // Jumlah pembayaran sesuai total pesanan
    $payment->save();

    return redirect()->route('yourdeliverie.index')->with('success', 'Payment successful! Your order has been updated.');
}

function order ()
{
    $customer = Auth::guard('customer')->user();

    if (!$customer) {
        return redirect()->route('customer.login')->with('error', 'You must be logged in to view your cart.');
    }
    $myorder = Order::where('customer_id', $customer->id)->with('customer')->get();

    return view('landing.yourorder', compact('myorder'));
}

public function deleteOrder(Request $request, $order_id)
{
    $customer = Auth::guard('customer')->user();

    if (!$customer) {
        return redirect()->route('customer.login')->with('error', 'You must be logged in to delete an order.');
    }

    $order = Order::where('id', $order_id)->where('customer_id', $customer->id)->firstOrFail();

    if ($order && $order->status === 'unpaid') {
        // Get order details
        $orderDetails = $order->orderDetails;

        // Update stock quantity for each product in the order
        foreach ($orderDetails as $detail) {
            $product = $detail->product;
            $product->stok_quantity += $detail->quantity;
            $product->save();
        }

        // Delete the order
        $order->delete();

        return redirect()->route('yourorder.index')->with('success', 'Order deleted successfully and stock updated.');
    }

    return redirect()->route('yourorder.index')->with('error', 'Only unpaid orders can be deleted.');
}


public function deliverie()
{
    // Getting the currently authenticated customer
    $customer = Auth::guard('customer')->user();

    // Checking if the customer is logged in
    if (!$customer) {
        return redirect()->route('customer.login')->with('error', 'You must be logged in to view your deliveries.');
    }

    // Fetching deliveries related to the customer's orders and loading the related order details and products
    $deliveries = Deliverie::whereHas('order', function ($query) use ($customer) {
        $query->where('customer_id', $customer->id);
    })->with(['order.orderDetails.product'])->get();

    // Sending deliveries data to the view
    return view('landing.deliverie', compact('deliveries'));
}

public function markAsDone(Deliverie $delivery)
{
    $delivery->status = 'Done';
    $delivery->save();

    return redirect()->route('yourdeliverie.index')->with('success', 'Delivery marked as done.');
}






    

}
