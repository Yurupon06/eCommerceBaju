@extends('landing.master')
@include('landing.main')

<style>
    .address-container {
        word-wrap: break-word;
        overflow-wrap: break-word;
    }

    .modal .modal-body .form-group .form-control {
        white-space: normal;
        overflow: hidden;
    }

    .modal {
        z-index: 1000;
        position: fixed;
    }
</style>

<form action="{{ route('cart.updateAll') }}" method="POST" class="bg0 p-t-75 p-b-85" id="cartForm">
    @csrf
    <div class="container">
        <div class="row">
            <div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
                <div class="m-l-25 m-r--38 m-lr-0-xl">
                    <div class="wrap-table-shopping-cart">
                        <table class="table-shopping-cart">
                            <tr class="table_head">
                                <th class="column-1">Product</th>
                                <th class="column-2"></th>
                                <th class="column-3">Price</th>
                                <th class="column-4">Quantity</th>
                                <th class="column-5">Total</th>
                            </tr>
                            @if ($wishlistItems->isNotEmpty())
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
                                    <td class="column-4">
                                        <div class="wrap-num-product flex-w m-l-auto m-r-0">
                                            <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                                                <i class="fs-16 zmdi zmdi-minus"></i>
                                            </div>
                                            <input class="mtext-104 cl3 txt-center num-product" type="number" name="quantities[{{ $item->id }}]" value="{{ $item->quantity }}" min="0" max="{{$item->product->stok_quantity}}" onchange="handleQuantityChange(this)">
                                            <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
                                                <i class="fs-16 zmdi zmdi-plus"></i>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="column-5">
                                        @if ($item->product->discount)
                                            ${{ number_format($item->product->price * (1 - $item->product->discount->percentage / 100) * $item->quantity, 2) }}
                                        @else
                                            ${{ number_format($item->product->price * $item->quantity, 2) }}
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            @else
                                <td>
                                    <span>empty cart</span>
                                </td>
                            @endif
                        </table>
                    </div>
                    <div class="flex-w flex-sb-m bor15 p-t-18 p-b-15 p-lr-40 p-lr-15-sm">
                        @if ($wishlistItems->isNotEmpty())
                            <button type="submit" class="flex-c-m stext-101 cl2 size-119 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10">
                                Update Cart
                            </button>
                            <span>to delete change quantity into zero</span>
                        @endif
                    </div>
                </div>
            </div>
        </form>
            <div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
                <div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
                    <h4 class="mtext-109 cl2 p-b-30">Cart Totals</h4>
                    <div class="flex-w flex-t bor12 p-b-13">
                        <div class="size-208">
                            <span class="stext-110 cl2">Subtotal:</span>
                        </div>
                        <div class="size-209">
                            <span class="mtext-110 cl2">
                                ${{ number_format($wishlistItems->sum(function ($item) {
                                    return $item->product->discount ? 
                                           ($item->product->price * (1 - $item->product->discount->percentage / 100) * $item->quantity) :
                                           $item->product->price * $item->quantity;
                                }), 2) }}
                            </span>
                        </div>
                    </div>
                    <br>
                    <h4 class="mtext-109 cl2 p-b-30">Shipping</h4>
                    <div class="flex-w flex-t bor12 p-t-15 p-b-30">
                        <div class="size-208 margin-bottom">
                            <span class="stext-110 cl2">Name:</span>
                        </div>
                        <div class="size-209 margin-bottom">
                            <span class="mtext-110 cl">{{ Auth::guard('customer')->user()->name }}</span>
                        </div>
                        <div class="size-208 margin-bottom">
                            <span class="stext-110 cl2">Address:</span>
                        </div>
                        <div class="size-209 margin-bottom address-container">
                            <span class="mtext-110 cl">{{ Auth::guard('customer')->user()->alamat1 }}</span>
                        </div>
                        <div>
                            <a href="#" data-toggle="modal" data-target="#editAddressModal">Change Address</a>
                        </div>
                        
                    </div>
                    <div class="flex-w flex-t p-t-27 p-b-33">
                        <div class="size-208">
                            <span class="mtext-101 cl2">Total:</span>
                        </div>
                        <div class="size-209 p-t-1">
                            <span class="mtext-110 cl2">
                                ${{ number_format($wishlistItems->sum(function ($item) {
                                    return $item->product->discount ? 
                                           ($item->product->price * (1 - $item->product->discount->percentage / 100) * $item->quantity) :
                                           $item->product->price * $item->quantity;
                                }), 2) }}
                            </span>
                        </div>
                    </div>

                    @if ($wishlistItems->isNotEmpty())
                        <form action="{{route('checkout.process')}}" method="POST">
                            @csrf
                            <button type="submit" class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer">Proceed to Checkout</button>
                        </form>
                    @else
                        <span>Cart Kosong</span>
                        <br>
                        <div>
                            <a href="{{route('shop.index')}}"><span>back to shop</span></a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

<!-- Modal -->
<div class="modal fade" id="editAddressModal" tabindex="-1" role="dialog" aria-labelledby="editAddressModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editAddressModalLabel">Change Address</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('profile.updateAddress') }}" method="POST">
          @csrf
          <div class="modal-body">
            <div class="form-group">
              <label for="alamat1" class="col-form-label">Address:</label>
              <input type="text" class="form-control" id="alamat1" name="alamat1" value="{{ Auth::guard('customer')->user()->alamat1 }}" required>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  


<script>
    function handleQuantityChange(input) {
        if (input.value == 0) {
            // Submit the form immediately if quantity is set to zero
            document.getElementById('cartForm').submit();
        }
    }
</script>
