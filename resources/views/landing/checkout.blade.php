@extends('landing.master')
@include('landing.main')

<style>
    .cell-padding {
        padding-left: 10px; /* Atau nilai padding yang diinginkan */
        padding-right: 10px; /* Atau nilai padding yang diinginkan */
    }
    .flex-w {
    display: flex;
    flex-wrap: wrap;
    }

    .flex-sb {
    justify-content: space-between;
    }

    .mtext-110 {
    margin-right: 10px; /* Menambahkan jarak antara harga dan tombol */
    }

    .mb-50 {
        margin-bottom: 50px;
    }
    

</style>

    

<br>
<div class="mb-50">
    <div class="row">
        <div class="col-lg-10 col-xl-7 m-lr-auto m-b-50" >
            <div>
                <table>
                    <tr class="table_head">
                        <th class="column-1">Alamat Pengiriman</th>
                    </tr>
                    <tr class="table_row">
                        <td>
                            {{ Auth::guard('customer')->user()->name }} ( {{ Auth::guard('customer')->user()->phone }} )
                        </td>
                        <td class="cell-padding">
                            {{ Auth::guard('customer')->user()->alamat1 }} 
                        </td>
                    </tr>
                </table>
            </div>
            
        </div>
        <br>
        <div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
                <div class="wrap-table-shopping-cart">
                    <table class="table-shopping-cart">
                        <tr class="table_head">
                            <th class="column-1">Product</th>
                            <th class="column-2"></th>
                            <th class="column-3">Price</th>
                            <th class="column-4">Quantity</th>
                            <th class="column-5">Subtotal</th>
                        </tr>
                        @foreach ($wishlistItems as $item)
                        <tr class="table_row">
                            <td class="column-1">
                                <div class="how-itemcart1">
                                    <img src="{{ asset('storage/' . $item->product->image1_url) }}" alt="IMG">
                                </div>
                            </td>
                            <td class="column-2">{{ $item->product->product_name }}</td>
                            <td class="column-3">
                                @if ($item->product->discount)
                                    ${{ number_format($item->product->price * (1 - $item->product->discount->percentage / 100), 2) }}
                                    <span class="text-danger"><del>${{ number_format($item->product->price, 2) }}</del></span>
                                @else
                                    ${{ number_format($item->product->price, 2) }}
                                @endif
                            </td>
                            <td class="column-4">{{ $item->quantity }}x</td>
                            <td class="column-5">
                                @if ($item->product->discount)
                                    ${{ number_format($item->product->price * (1 - $item->product->discount->percentage / 100) * $item->quantity, 2) }}
                                @else
                                    ${{ number_format($item->product->price * $item->quantity, 2) }}
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
                <br>
                <div class="flex-w flex-t p-t-27 p-b-33">
                    <div class="size-208">
                        <span class="mtext-101 cl2">
                            Total:
                        </span>
                    </div>
                
                    <div class="size-209 p-t-1 flex-w flex-sb">
                        <span class="mtext-110 cl2">
                            ${{ number_format($wishlistItems->sum(function ($item) {
                                return $item->product->discount ? 
                                       ($item->product->price * (1 - $item->product->discount->percentage / 100) * $item->quantity) :
                                       $item->product->price * $item->quantity;
                            }), 2) }}
                        </span>
                        @if ($order->status === 'unpaid')
                        <form action="{{ route('pay.now', $order->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="flex-c-m stext-101 cl0 size-11 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer">
                                Pay Now
                            </button>
                        </form>
                    @else
                        <span class="mtext-110 cl2" style="color: rgb(32, 211, 32); font-weight: bold;">
                            Already paid    
                        </span>
                        <a href="{{route('yourdeliverie.index', $order->id)}}" class="flex-c-m stext-101 cl0 size-11 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer">
                            Check Deliverie Detail
                        </a>
                    @endif
                    </div>
                </div>
                
        </div>
    </div>
</div>




