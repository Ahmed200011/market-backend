<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    {{-- <title>MultiShop - Online Shop Website Template</title> --}}
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">
    <title>@yield('page_title', 'page')</title>


    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('front/lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('front/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('front/css/style.css') }}" rel="stylesheet">
</head>

<body>
    <!-- Topbar Start -->
    <div class="container-fluid">
        <div class="row bg-secondary py-1 px-xl-5">
            <div class="col-lg-6 d-none d-lg-block">
                <div class="d-inline-flex align-items-center h-100">
                    <a class="text-body mr-3" href="">About</a>
                    <a class="text-body mr-3" href="">Contact</a>
                    <a class="text-body mr-3" href="">Help</a>
                    <a class="text-body mr-3" href="">FAQs</a>
                </div>
            </div>
            <div class="col-lg-6 text-center text-lg-right">
                <div class="d-inline-flex align-items-center">
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">My
                            Account</button>
                        @if (Auth::user())
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="{{ asset('dashboard/assets/images/profile/default.jpg') }}" alt=""
                                        width="35" height="35" class="rounded-circle">
                                </a>
                                {{-- <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" --}}
                                {{-- aria-labelledby="drop2"> --}}
                                <div class="message-body">
                                    <div class="ml-3">
                                        <p>{{ Auth::user()->name }}</p>
                                        <p>{{ Auth::user()->email }}</p>
                                    </div>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button class="btn btn-outline-danger mx-3 mt-2 d-block">
                                            {{ __('validation.custom.log-out') }}
                                        </button>
                                    </form>

                                </div>
                                {{-- </div> --}}
                            </div>
                        @else
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="{{ route('login') }}">Login</a>
                                <a class="dropdown-item" href="{{ route('register') }}">Register</a>
                            </div>
                        @endif
                    </div>
                    {{-- <div class="btn-group mx-2">
                        <button type="button" class="btn btn-sm btn-light dropdown-toggle"
                            data-toggle="dropdown">USD</button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <button class="dropdown-item" type="button">EUR</button>
                            <button class="dropdown-item" type="button">GBP</button>
                            <button class="dropdown-item" type="button">CAD</button>
                        </div>
                    </div>
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-light dropdown-toggle"
                            data-toggle="dropdown">EN</button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <button class="dropdown-item" type="button">FR</button>
                            <button class="dropdown-item" type="button">AR</button>
                            <button class="dropdown-item" type="button">RU</button>
                        </div>
                    </div> --}}
                </div>
                <div class="d-inline-flex align-items-center d-block d-lg-none">
                    <a href="" class="btn px-0 ml-2">
                        <i class="fas fa-heart text-dark"></i>
                        <span class="badge text-dark border border-dark rounded-circle"
                            style="padding-bottom: 2px;">0</span>
                    </a>
                    <a href="" class="btn px-0 ml-2">
                        <i class="fas fa-shopping-cart text-dark"></i>
                        <span class="badge text-dark border border-dark rounded-circle"
                            style="padding-bottom: 2px;">0</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="row align-items-center justify-content-between bg-light py-3 px-xl-5 d-none d-lg-flex ">
            <div class="col-lg-4">
                <a href="" class="text-decoration-none">
                    <span class="h1 text-uppercase text-primary bg-dark px-2">Multi</span>
                    <span class="h1 text-uppercase text-dark bg-primary px-2 ml-n1">Shop</span>
                </a>
            </div>

            <div class="col-lg-4 col-6 text-right">
                <p class="m-0">Customer Service</p>
                <a href="tel:01009198079">
                    <h5 class="m-0">01009198079</h5>
                </a>

            </div>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <div class="container-fluid bg-dark mb-30">
        <div class="row px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
                <a class="btn d-flex align-items-center justify-content-between bg-primary w-100" data-toggle="collapse"
                    href="#navbar-vertical" style="height: 65px; padding: 0 30px;">
                    <h6 class="text-dark m-0"><i class="fa fa-bars mr-2"></i>Categories</h6>
                    <i class="fa fa-angle-down text-dark"></i>
                </a>
                <nav class="collapse position-absolute navbar navbar-vertical navbar-light align-items-start p-0 bg-light"
                    id="navbar-vertical" style="width: calc(100% - 30px); z-index: 999;">
                    <div class="navbar-nav w-100">
                        @foreach ($Categories as $category)
                            <div class="nav-item dropdown dropright">
                                @if ($category->children()->count() > 0)
                                    <a href="#" class="nav-link dropdown-toggle"
                                        data-toggle="dropdown">{{ $category->category_name }}
                                        <i class="fa fa-angle-right float-right mt-1"></i></a>
                                    <div class="dropdown-menu position-absolute rounded-0 border-0 m-0">
                                        @foreach ($category->children as $children)
                                            <a href=""
                                                class="dropdown-item">{{ $children->category_name }}</a>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </nav>
            </div>
            <div class="col-lg-9">
                <nav class="navbar navbar-expand-lg bg-dark navbar-dark py-3 py-lg-0 px-0">
                    <a href="" class="text-decoration-none d-block d-lg-none">
                        <span class="h1 text-uppercase text-dark bg-light px-2">Multi</span>
                        <span class="h1 text-uppercase text-light bg-primary px-2 ml-n1">Shop</span>
                    </a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse"
                        data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto py-0">
                            <a href="{{ route('page.home') }}" @class(['nav-item', 'nav-link', 'active' => request()->routeIs('page.home')])>Home</a>

                            <a href="{{ route('page.shop.index') }}"  @class(['nav-item', 'nav-link', 'active' => request()->routeIs('page.shop.index')])>Shop</a>

                            <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" @class(['nav-link', 'dropdown-toggle', 'active'=>request()->is('page.cart/*') ? '' : 'hidden']) data-toggle="dropdown">Pages <i
                                        class="fa fa-angle-down mt-1"></i></a>
                                <div class="dropdown-menu bg-primary rounded-0 border-0 m-0">
                                    <a href="{{ route('page.cart.index') }}" @class(['dropdown-item','active'=>request()->routeIs('page.cart.edit')])>Shopping Cart</a>
                                    <a href="{{route('page.payment.index')}}" @class(['dropdown-item','active'=>request()->routeIs('page.payment.edit')])>Checkout</a>
                                </div>
                            </div>
                            <a href="{{ route('page.contact') }}" @class(['nav-item', 'nav-link', 'active' => request()->routeIs('page.contact')])>Contact</a>
                        </div>
                        @if (Auth::user())
                            <div class="navbar-nav ml-auto py-0 d-none d-lg-block">
                                <a href="" class="btn px-0">
                                    <i class="fas fa-heart text-primary"></i>
                                    <span class="badge text-secondary border border-secondary rounded-circle"
                                        style="padding-bottom: 2px;">0</span>
                                </a>
                                <a href="{{ route('page.cart.index') }}" class="btn px-0 ml-3">
                                    <i class="fas fa-shopping-cart text-primary"></i>
                                    <span class="badge text-secondary border border-secondary rounded-circle"
                                        style="padding-bottom: 2px;">{{ Auth::user()->cart()->count() }}</span>
                                </a>
                            </div>
                        @endif
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <!-- Navbar End -->
