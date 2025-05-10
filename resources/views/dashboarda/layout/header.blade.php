@php
    use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
@endphp
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('page_title', 'Main Dashboard')</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('dashboard/assets/images/logos/logo2.png') }}" />
    <link rel="stylesheet" href="{{ asset('dashboard/assets/css/styles.min.css') }}" />
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div>
                <div class="brand-logo d-flex align-items-center justify-content-between">
                    <a href="{{ route('dashboard.main') }}" class="text-nowrap logo-img">
                        <img src="{{ asset('dashboard/assets/images/logos/logo2.png') }}" width="180" height="130"
                            alt="" />
                    </a>
                    <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                        <i class="ti ti-x fs-8"></i>
                    </div>
                </div>
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
                    <ul id="sidebarnav">
                        <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                            <span class="hide-menu">{{ __('validation.custom.home') }}</span>
                        </li>
                        <li class="sidebar-item">
                            <a @class(['sidebar-link','active'=>request()->routeIs('dashboard.main')]) href="{{ route('dashboard.main') }}" aria-expanded="false">
                                <span>
                                    <i class="ti ti-layout-dashboard"></i>
                                </span>
                                <span class="hide-menu">{{ __('validation.custom.dashboard') }}</span>
                            </a>
                        </li>
                        <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                            <span class="hide-menu">Category</span>
                        </li>
                        <li class="sidebar-item">
                            <a @class(['sidebar-link','active'=>request()->routeIs('dashboard.user.index')]) href="{{route('dashboard.user.index')}}" aria-expanded="false">
                                <span>
                                    <i class="ti ti-article"></i>
                                </span>
                                <span class="hide-menu">Users</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a @class(['sidebar-link','active'=>request()->routeIs('dashboard.Category.index')]) href="{{route('dashboard.Category.index')}}" aria-expanded="false">
                                <span>
                                    <i class="ti ti-article"></i>
                                </span>
                                <span class="hide-menu">Category</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a @class(['sidebar-link','active'=>request()->routeIs('dashboard.product.index')]) href="{{route('dashboard.product.index')}}" aria-expanded="false">
                                <span>
                                    <i class="ti ti-article"></i>
                                </span>
                                <span class="hide-menu">product</span>
                            </a>
                        </li>

                        <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                            <span class="hide-menu">website</span>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('page.home') }}" aria-expanded="false">
                                <span>
                                    <i class="ti ti-login"></i>
                                </span>
                                <span class="hide-menu">{{ __('website') }}</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('register') }}" aria-expanded="false">
                                <span>
                                    <i class="ti ti-user-plus"></i>
                                </span>
                                <span class="hide-menu">{{ __('validation.custom.register') }}</span>
                            </a>
                        </li>

                    </ul>

                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!--  Sidebar End -->

        <!--  Main wrapper -->
        <div class="body-wrapper">
            <!--  Header Start -->
            <header class="app-header">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <ul class="navbar-nav">
                        <li class="nav-item d-block d-xl-none">
                            <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse"
                                href="javascript:void(0)">
                                <i class="ti ti-menu-2"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link nav-icon-hover" href="javascript:void(0)">
                                <i class="ti ti-bell-ringing"></i>
                                <div class="notification bg-primary rounded-circle"></div>
                            </a>
                        </li>
                    </ul>
                    <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
                        <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">

                            {{-- <a href="https://adminmart.com/product/modernize-free-bootstrap-admin-dashboard/" target="_blank" class="btn btn-primary">Download Free</a> --}}
                            <li class="nav-item dropdown">
                                <a class="nav-link nav-icon-hover icon-link icon-link-hover" href="javascript:void(0)"
                                    id="drop2" data-bs-toggle="dropdown" aria-expanded="false">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24"
                                        height="24">
                                        <text x="50%" y="55%" font-size="20" font-family="Arial" font-weight="bold"
                                            fill="black" text-anchor="middle" alignment-baseline="middle">A</text>
                                    </svg>
                                </a>

                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up"
                                    aria-labelledby="drop2">
                                    @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                        <div class="message-body">
                                            <a rel="alternate" hreflang="{{ $localeCode }}"
                                                href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}"
                                                class="d-flex align-items-center gap-2 dropdown-item">


                                                <p class="mb-0 fs-3">{{ $properties['native'] }}</p>
                                            </a>

                                        </div>
                                    @endforeach
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="{{ asset('dashboard/assets/images/profile/default.jpg') }}"
                                        alt="" width="35" height="35" class="rounded-circle">
                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up"
                                    aria-labelledby="drop2">
                                    <div class="message-body">
                                        <a href="{{route('profile.edit')}}"
                                            class="d-flex align-items-center gap-2 dropdown-item">
                                            <i class="ti ti-user fs-6"></i>
                                            <p class="mb-0 fs-3">{{__('validation.custom.My-Account')}}</p>
                                        </a>
                                        <a href="javascript:void(0)"
                                            class="d-flex align-items-center gap-2 dropdown-item">
                                            <i class="ti ti-list-check fs-6"></i>
                                            <p class="mb-0 fs-3">My Task</p>
                                        </a>

                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf

                                            <button
                                                class="btn btn-outline-primary mx-3 mt-2 d-block">
                                                {{-- onclick="event.preventDefault(); --}}
                                                                {{-- this.closest('form').submit();" --}}
                                                {{ __('validation.custom.log-out') }}
                                            </button>
                                        </form>
                                        {{-- <a href="{{ route('logout') }}" --}}
                                        {{-- class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a> --}}
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <!--  Header End -->
            <div class="container-fluid">
