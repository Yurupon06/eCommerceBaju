@extends('landing.master')
@include('landing.main')

<body class="animsition">
    
   


    

    <!-- Product Detail -->
    @if($products instanceof App\Models\Product)
    <section class="sec-product-detail bg0 p-t-65 p-b-60">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-7 p-b-30">
                    <div class="p-l-25 p-r-30 p-lr-0-lg">
                        <div class="wrap-slick3 flex-sb flex-w">
                            <div class="wrap-slick3-dots"></div>
                            <div class="wrap-slick3-arrows flex-sb-m flex-w"></div>

                            <div class="slick3 gallery-lb">
                                @if($products->image1_url)
                                    <div class="item-slick3" data-thumb="{{ asset('storage/' . $products->image1_url) }}">
                                        <div class="wrap-pic-w pos-relative">
                                            <img src="{{ asset('storage/' . $products->image1_url) }}" alt="IMG-PRODUCT">
                                        </div>
                                    </div>
                                @endif

                                @if($products->image2_url)
                                    <div class="item-slick3" data-thumb="{{ asset('storage/' . $products->image2_url) }}">
                                        <div class="wrap-pic-w pos-relative">
                                            <img src="{{ asset('storage/' . $products->image2_url) }}" alt="IMG-PRODUCT">
                                        </div>
                                    </div>
                                @endif

                                @if($products->image3_url)
                                    <div class="item-slick3" data-thumb="{{ asset('storage/' . $products->image3_url) }}">
                                        <div class="wrap-pic-w pos-relative">
                                            <img src="{{ asset('storage/' . $products->image3_url) }}" alt="IMG-PRODUCT">
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-5 p-b-30">
                    <div class="p-r-50 p-t-5 p-lr-0-lg">
                        <h4 class="mtext-105 cl2 js-name-detail p-b-14">
                            {{ $products->product_name }}
                            @if ($products->discount)
                            <span style="background-color: red; color: white; padding: 5px; font-size: 12px; font-weight: bold;">{{ $products->discount->percentage }}% OFF</span>
                        @endif
                        </h4>
                        

                        <span class="stext-105 cl3">
                            @if($products->discount)
                                ${{ number_format($products->price * (1 - $products->discount->percentage / 100), 2) }}
                                <span class="text-danger"><del>${{ number_format($products->price, 2) }}</del></span>
                            @else
                                ${{ number_format($products->price, 2) }}
                            @endif
                        </span>

                        <p class="stext-102 cl3 p-t-23">
                            {{ $products->description }}.
                        </p>

                        <!--  -->
                        <div class="p-t-33">

                            <div class="flex-w flex-r-m p-b-10">
                                <div class="size-204 flex-w flex-m respon6-next">
                                    <form action="{{ route('wishlist.add', ['productId' => $products->id]) }}" method="POST">
                                        @csrf
                                        <div class="wrap-num-product flex-w m-r-20 m-tb-10">
                                            <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                                                <i class="fs-16 zmdi zmdi-minus"></i>
                                            </div>

                                            <input class="mtext-104 cl3 txt-center num-product" type="number" name="quantity" value="1" min="1" max="{{$products->stok_quantity}}">

                                            <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
                                                <i class="fs-16 zmdi zmdi-plus"></i>
                                            </div>
                                        </div>
                                        <button type="submit" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn3 p-lr-15 trans-04 js-addcart-detail">
                                            Add to Cart
                                        </button>
                                    </form>
                                </div>
                            </div>  
                        </div>

                        <!--  -->
                        <div class="flex-w flex-m p-l-100 p-t-40 respon7">
                            <div class="flex-m bor9 p-r-10 m-r-11">
                                <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10">
                                    <i class="fa fa-facebook"></i>
                                </a>
                            </div>

                            <div class="flex-m bor9 p-r-10 m-r-11">
                                <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10">
                                    <i class="fa fa-twitter"></i>
                                </a>
                            </div>

                            <div class="flex-m bor9 p-r-10 m-r-11">
                                <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10">
                                    <i class="fa fa-google-plus"></i>
                                </a>
                            </div>

                            <div class="flex-m bor9 p-r-10 m-r-11">
                                <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10">
                                    <i class="fa fa-envelope"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bor10 m-t-50 p-t-43 p-b-40">
				<!-- Tab01 -->
				<div class="tab01">
							<div class="row">
								<div class="col-sm-10 col-md-8 col-lg-6 m-lr-auto">
									<div class="p-b-30 m-lr-15-sm">
										<!-- Review -->
										<div class="flex-w flex-t p-b-68">

											<div class="size-207">
												<div class="flex-w flex-sb-m p-b-17">
													<span class="mtext-107 cl2 p-r-20">
														Ariana Grande
													</span>

													<span class="fs-18 cl11">
														<i class="zmdi zmdi-star"></i>
														<i class="zmdi zmdi-star"></i>
														<i class="zmdi zmdi-star"></i>
														<i class="zmdi zmdi-star"></i>
														<i class="zmdi zmdi-star-half"></i>
													</span>
												</div>

												<p class="stext-102 cl6">
													Quod autem in homine praestantissimum atque optimum est, id deseruit. Apud ceteros autem philosophos
												</p>
											</div>
										</div>
										
										<!-- Add review -->
										<form class="w-full">
											<h5 class="mtext-108 cl2 p-b-7">
												Add a review
											</h5>

											<p class="stext-102 cl6">
												Your email address will not be published. Required fields are marked *
											</p>

											<div class="flex-w flex-m p-t-50 p-b-23">
												<span class="stext-102 cl3 m-r-16">
													Your Rating
												</span>

												<span class="wrap-rating fs-18 cl11 pointer">
													<i class="item-rating pointer zmdi zmdi-star-outline"></i>
													<i class="item-rating pointer zmdi zmdi-star-outline"></i>
													<i class="item-rating pointer zmdi zmdi-star-outline"></i>
													<i class="item-rating pointer zmdi zmdi-star-outline"></i>
													<i class="item-rating pointer zmdi zmdi-star-outline"></i>
													<input class="dis-none" type="number" name="rating">
												</span>
											</div>

											<div class="row p-b-25">
												<div class="col-12 p-b-5">
													<label class="stext-102 cl3" for="review">Your review</label>
													<textarea class="size-110 bor8 stext-102 cl2 p-lr-20 p-tb-10" id="review" name="review"></textarea>
												</div>

												<div class="col-sm-6 p-b-5">
													<label class="stext-102 cl3" for="name">Name</label>
													<input class="size-111 bor8 stext-102 cl2 p-lr-20" id="name" type="text" name="name">
												</div>

												<div class="col-sm-6 p-b-5">
													<label class="stext-102 cl3" for="email">Email</label>
													<input class="size-111 bor8 stext-102 cl2 p-lr-20" id="email" type="text" name="email">
												</div>
											</div>

											<button class="flex-c-m stext-101 cl0 size-112 bg7 bor11 hov-btn3 p-lr-15 trans-04 m-b-10">
												Submit
											</button>
										</form>
									</div>
								</div>
							</div>
				</div>
			</div>
        </div>
    </section>
@else
    <p>Product not found.</p>
@endif




<div class="btn-back-to-top" id="myBtn">
        <span class="symbol-btn-back-to-top">
            <i class="zmdi zmdi-chevron-up"></i>
        </span>
    </div>


</body>
</html>
