<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>@yield('title')</title>

    @stack('prepend-style')
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
    <link href="/style/main.css" rel="stylesheet" />
    @stack('addon-style')
</head>

<body>

    <div class="page-dashboard">
        <div class="d-flex" id="wrapper" data-aos="fade-right">
            <!-- Sidebar -->
            <div class="border-right" id="sidebar-wrapper">
                <div class="sidebar-heading text-center">
                    <img src="/images/Logo.svg" alt="" class="my-4">
                </div>
                <div class="list-group list-group-flush ">
                    <a href="{{ route('dashboard') }}" class="list-group-item list-group-item-active  mt-5 {{ (request()->is('dashboard')) ? 'active' : ''  }}">
                        <img src="/images/SVG/dashboard.svg" alt="" class="mr-2 ">Dashboard
                    </a>
                    <a href="#" class="list-group-item list-group-item-active ">
                        <img src="/images/SVG/wish.svg" alt="" class="mr-2">My Wishlist
                    </a>
                    <a href="{{ route('dashboard-transactions') }}" class="list-group-item list-group-item-active {{ (request()->is('dashboard/transactions*')) ? 'active' : ''}}">
                        <img src="/images/SVG/transaction.svg" alt="" class="mr-2">Transaction
                    </a>
                    <a href="{{ route('dashboard-profile') }}" class="list-group-item list-group-item-active {{ (request()->is('dashboard/profile*')) ? 'active' : '' }}">
                        <img src="/images/SVG/profile.svg" alt="" class="mr-2">Profile
                    </a>
                    <a href="{{ route('logout') }}" 
					   onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="list-group-item list-group-item-active ">
                        <img src="/images/SVG/sign-out-dashboard.svg" alt="">
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                        </form>
                    </a>
                </div>
            </div>

            <!-- Page Content -->
            <div id="page-content-wrapper">
                <nav class="navbar navbar-expand-lg navbar-light navbar-store fixed-top" data-aos="fade-down">
                    <div class="container-fluid">
                        <button class="btn btn-secondary d-md-none mr-auto mr-2" id="menu-toggle">
                            <img src="/images/view-headline.svg" alt="">
                        </button>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav ">
                        <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNav">

                            <!-- Desktop version -->
                            <ul class="navbar-nav navbar-store d-none d-lg-flex ml-auto">
                                <li class="nav-item dropdown">
                                    <a href="#" class="nav-link" id="navbarDropdown" role="button" data-toggle="dropdown">
                                        <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=FF7158&color=FFF" height="60" alt="" class="rounded-circle mr-2 profile-picture"> Hi, {{ Auth::user()->name }}
                                    </a>
                                    <div class="dropdown-menu">
                                        <a href="{{ route('home') }}" class="dropdown-item">Home</a>
                                        <a href="{{ route('dashboard-profile') }}" class="dropdown-item">Setting</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="{{ route('logout') }}" 
								            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout
								        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                    <li>
                                        <a href="{{ route('cart') }}" class="nav-link d-inline-block mt-2">
                                            @php
                                                $carts = \App\Cart::where('users_id', Auth::user()->id)->count();
                                            @endphp
                                            @if ($carts > 0 )
                                                <img src="/images/icon_cart_filled.svg" alt="">
                                                <div class="card-badge">{{ $carts }}</div>
                                            @else
                                                <img src="/images/icon_cart_empty.svg" alt="">
                                            @endif
                                        </a>
                                    </li>
                                </li>
                            </ul>
                            {{-- Mobile --}}
                            <ul class="navbar-nav navbar-store d-block d-lg-none">
                                <li class="nav-item">
                                    <a href="{{ route('dashboard') }}" class="nav-link">Hi, {{ Auth::user()->name }}</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('cart') }}" class="nav-link d-inline-block">Cart</a>
                                </li>
                            </ul>

                        </div>
                    </div>
                </nav>

                {{-- Content --}}
                @yield('content')
            </div>
        </div>
    </div>

     @stack('prepend-script')
    <!-- Bootstrap core JavaScript -->
    <script src="/vendor/jquery/jquery.slim.min.js"></script>
    <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
    <script src="/script/navbar-scroll.js"></script>
    <script>
        $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });
    </script>
    @stack('addon-script')
</body>

</html>