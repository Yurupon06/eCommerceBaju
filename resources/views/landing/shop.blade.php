@extends('landing.master')
@include('landing.main')
<body class="animsition">
	


	

	
	<!-- Product -->
	<div class="bg0 m-t-23 p-b-140">
		<div class="container">
			<div class="flex-w flex-sb-m p-b-52">
				<div class="flex-w flex-l-m filter-tope-group m-tb-10">
					<button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5 how-active1" data-filter="*">
						All Products
					</button>
				</div>

			</div>
			<div class="bg0 m-t-23 p-b-140">
				<div class="container">
					<div class="row isotope-grid">
						@foreach($products as $product)
						<div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item {{ $product->category ? strtolower($product->category->name) : 'Uncategorized' }}">
							<div class="block2">
								<div class="block2-pic hov-img0" style="width: 15rem !important; height: 15rem;">
									<img style="width: 100%" src="storage/{{ $product->image1_url }}" alt="{{ $product->product_name }}">
									@if($product->discount)
										<span style="position: absolute; top: 10px; left: 10px; background-color: red; color: white; padding: 5px; font-size: 12px; font-weight: bold;">{{ $product->discount->percentage }}% OFF</span>
									@endif
									<a href="{{route('shopdetail.index', $product->id)}}" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04">
										Quick View
									</a>
								</div>
								<div class="block2-txt flex-w flex-t p-t-14">
									<div class="block2-txt-child1 flex-col-l ">
										<a href="" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
											{{ $product->product_name }}
										</a>
										<span class="stext-105 cl3">
											@if($product->discount)
												${{ number_format($product->price * (1 - $product->discount->percentage / 100), 2) }}
												<span class="text-danger"><del>${{ number_format($product->price, 2) }}</del></span>
											@else
												${{ number_format($product->price, 2) }}
											@endif
										</span>
					
									</div>
								</div>
							</div>
						</div>
						@endforeach
					</div>
				</div>
			</div>
		</div>
	</div>
		


	<!-- Back to top -->
	<div class="btn-back-to-top" id="myBtn">
		<span class="symbol-btn-back-to-top">
			<i class="zmdi zmdi-chevron-up"></i>
		</span>
	</div>


</body>
</html>