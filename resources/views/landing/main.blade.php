<style>
    .wrap-menu-desktop {
    position: relative; /* Set position to relative */
    z-index: 1; /* Ensure the navbar is above normal content */
}

.menu-desktop {
    position: relative; /* Set position to relative */
    z-index: 1; /* Ensure the menu is above normal content */
}

.wrap-icon-header {
    position: relative; /* Set position to relative */
    z-index: 1; /* Ensure the icon header is above normal content */
}

.container-menu-desktop {
    position: relative;
    z-index: 1001; /* Ensure the navbar is on top of the modal */
}
</style>

<header class="header-v4">
    <!-- Header desktop -->
    <div class="container-menu-desktop">
        <!-- Topbar -->
        <div class="top-bar">
            <div class="content-topbar flex-sb-m h-full container">
                <div class="left-top-bar">
                    Free shipping for standard order over $100
                </div>
                <div class="right-top-bar flex-w h-full">
                    @auth('customer')
                        <a href="{{ route('profile.index') }}" class="flex-c-m trans-04 p-lr-25" >
                            {{ Auth::guard('customer')->user()->name }}
                        </a>
                        <a href="{{ route('customer.logout') }}" class="flex-c-m trans-04 p-lr-25" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('customer.logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    @else
                        <a href="{{ route('customer.login') }}" class="flex-c-m trans-04 p-lr-25">
                            Login
                        </a>
                        <a href="{{ route('customer.register') }}" class="flex-c-m trans-04 p-lr-25">
                            Register
                        </a>
                    @endauth
                </div>
            </div>
        </div>

        <!-- Wrap menu desktop with shadow -->
        <div class="wrap-menu-desktop how-shadow1">
            <nav class="limiter-menu-desktop container">
                <!-- Menu desktop -->
                <div class="menu-desktop">
                    <ul class="main-menu">
                        <li>
                            <a href="/">Home</a>
                        </li>
                        <li class="menu">
                            <a href="{{ route('shop.index') }}">Shop</a>
                        </li>
                    </ul>
                </div>	

                <!-- Icon header -->
                <div class="wrap-icon-header flex-w flex-r-m">
                    <a href="{{ route('cart.index') }}" class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11">
                        <i class="zmdi zmdi-shopping-cart"></i>
                    </a>
                </div>
            </nav>
        </div>	
    </div>
</header>
