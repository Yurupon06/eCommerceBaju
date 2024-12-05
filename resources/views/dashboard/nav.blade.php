<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 bg-gradient-dark" id="sidenav-main">
  <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href="https://demos.creative-tim.com/material-dashboard/pages/dashboard" target="_blank">
          <img src="../../assets/img/logo-ct.png" class="navbar-brand-img h-100" alt="main_logo">
          <span class="ms-1 font-weight-bold text-white">Material Dashboard 2</span>
      </a>
  </div>
  <hr class="horizontal light mt-0 mb-2">
  <div class="collapse navbar-collapse w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav">
          <li class="nav-item">
              <a class="nav-link text-white {{ request()->is('dashboard') ? 'active' : '' }}" href="dashboard">
                  <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                      <i class="material-icons opacity-10">dashboard</i>
                  </div>
                  <span class="nav-link-text ms-1">Dashboard</span>
              </a>
          </li>
          <li class="nav-item">
              <a class="nav-link {{ request()->is('productcategories') ? 'active' : '' }}" href="{{ route('productcategories.index') }}">
                  <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                      <i class="material-icons opacity-10">table_view</i>
                  </div>
                  <span class="nav-link-text ms-1">Product Category</span>
              </a>
          </li>
          <li class="nav-item">
              <a class="nav-link {{ request()->is('product') ? 'active' : '' }}" href="{{ route('product.index') }}">
                  <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                      <i class="material-icons opacity-10">receipt_long</i>
                  </div>
                  <span class="nav-link-text ms-1">Product</span>
              </a>
          </li>

          <li class="nav-item">
            <a class="nav-link {{ request()->is('discountcat') ? 'active' : '' }}" href="{{ route('discountcat.index')}}">
                <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="material-icons opacity-10">view_in_ar</i>
                </div>
                <span class="nav-link-text ms-1">Discount Categorie</span>
            </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->is('discount') ? 'active' : '' }}" href="{{ route('discount.index')}}">
              <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                  <i class="material-icons opacity-10">percent</i>
              </div>
              <span class="nav-link-text ms-1">Discount</span>
          </a>
      </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->is('order') ? 'active' : '' }}" href="{{ route('order.index')}}">
              <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                  <i class="material-icons opacity-10">add_shopping_cart</i>
              </div>
              <span class="nav-link-text ms-1">order</span>
          </a>
      </li>
      </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->is('orderdetail') ? 'active' : '' }}" href="{{ route('orderdetail.index')}}">
              <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                  <i class="material-icons opacity-10">view_in_ar</i>
              </div>
              <span class="nav-link-text ms-1">orderdetail</span>
          </a>
      </li>
      </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->is('deliverie') ? 'active' : '' }}" href="{{ route('deliverie.index')}}">
              <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                  <i class="material-icons opacity-10">view_in_ar</i>
              </div>
              <span class="nav-link-text ms-1">deliverie</span>
          </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ request()->is('customer') ? 'active' : '' }}" href="{{ route('customer.index')}}">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="material-icons opacity-10">account_box</i>
            </div>
            <span class="nav-link-text ms-1">Customer</span>
        </a>
    </li>
    @if (auth()->user()->roles == 'owner')
    <li class="nav-item">
        <a class="nav-link {{ request()->is('payment') ? 'active' : '' }}" href="{{ route('payment.index')}}">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="material-icons opacity-10">account_box</i>
            </div>
            <span class="nav-link-text ms-1">payment</span>
        </a>
    </li>
    @endif
      
        {{-- <li class="nav-item">
          <a class="nav-link {{ request()->is('wishlist') ? 'active' : '' }}" href="{{ route('wishlist.index')}}">
              <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                  <i class="material-icons opacity-10">view_in_ar</i>
              </div>
              <span class="nav-link-text ms-1">wishlist</span>
          </a>
      </li> --}}
      </ul>
  </div>
</aside>
