@extends('front.layout.app')
@section('content')

    <div class="container-fluid d-flex justify-content-center">
        <div class="col-lg-4 col-6  text-center">



            <form action="{{ route('page.shop.index') }}" method="get">

                <div class="input-group">
                    <select name="select"  value={{old('select')}} class="form-control" id="">
                        <option value=0>all</option>
                        @foreach ($Categories as $Category)
                        @foreach ($Category->children as $children)
                            <option value="{{ $children->id}}">{{ $children->category_name }}</option>
                        @endforeach
                        @endforeach

                    </select>
                    <input type="text" name="search"  value="{{old('search')}}" class="form-control" placeholder="Search for products">
                    <div class="input-group-append">
                        <button type="submit" class="input-group-text bg-transparent text-primary">
                            <i class="fa fa-search"></i>
                        </button>
                        <a href={{route('page.shop.index')}} class="input-group-text bg-transparent text-primary">
                            reload
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href={{route('page.home')}} >Home</a>
                    <a class="breadcrumb-item text-dark" href={{route('page.shop.index')}} >Shop</a>
                    <span class="breadcrumb-item active">Shop List</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->


    <!-- Shop Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-4">
                <!-- Price Start -->
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by
                        price</span></h5>
                <div class="bg-light p-4 mb-30">
                    <form action="{{ route('page.shop.index') }}" method="get" id="price-form">
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input"  onclick="submit()"  name=0 id="price-all">
                            <label class="custom-control-label" for="price-all">All Price</label>

                            {{-- <span class="badge border font-weight-normal">1000</span> --}}
                        </div>

                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" onclick="submit()" name="100" id="price-1">
                            <label class="custom-control-label" for="price-1">$0 - $100</label>
                            {{-- <span class="badge border font-weight-normal">150</span> --}}
                        </div>

                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" onclick="submit()"  name=200 id="price-2">
                            <label class="custom-control-label" for="price-2">$100 - $200</label>
                            {{-- <span class="badge border font-weight-normal">295</span> --}}
                        </div>

                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" onclick="submit()"  name=400 id="price-3">
                            <label class="custom-control-label" for="price-3">$300 - $400</label>
                            {{-- <span class="badge border font-weight-normal">246</span> --}}
                        </div>

                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" onclick="submit()"  name=1000 id="price-4">
                            <label class="custom-control-label" for="price-4">$500 - $1000</label>
                            {{-- <span class="badge border font-weight-normal">145</span> --}}
                        </div>

                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" onclick="submit()"  name=1500 id="price-5">
                            <label class="custom-control-label" for="price-5">$1000 - $1500</label>
                            {{-- <span class="badge border font-weight-normal">168</span> --}}
                        </div>

                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" onclick="submit()"  name=2000 id="price-6">
                            <label class="custom-control-label" for="price-6">$1500 - $2000</label>
                            {{-- <span class="badge border font-weight-normal">168</span> --}}
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" onclick="submit()"  name=3000 id="price-7">
                            <label class="custom-control-label" for="price-7">$2000 - $3000</label>
                            {{-- <span class="badge border font-weight-normal">168</span> --}}
                        </div>
                        <script>
                            function submit() {
                                document.getElementById('price-form').submit();
                            }
                        </script>
                    </form>
                </div>
                <!-- Price End -->

            </div>
            <!-- Shop Sidebar End -->


            <!-- Shop Product Start -->
            <div class="col-lg-9 col-md-8">
                <div class="row pb-3">
                    @foreach ($products as $product)
                        <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                            <div class="product-item bg-light mb-4">
                                <div class="product-img position-relative overflow-hidden h-100">
                                    <img class="img-fluid w-100 " style="object-fit: cover; height: 400px; width: 100%"
                                        @if (file_exists(public_path('dashboard/assets/images/products/' . $product->image))) src="{{ asset('dashboard/assets/images/products/' . $product->image) }}"
                                @else
                                src="{{ $product->image }}" @endif
                                        alt="{{ $product->product_name }}">
                                    <div class="product-action">
                                        <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="fa fa-shopping-cart"></i></a>
                                        <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="far fa-heart"></i></a>
                                     </div>
                                </div>
                                <div class="text-center py-4">
                                    <a class="h6 text-decoration-none text-truncate"
                                        href="">{{ Str::limit($product->product_name, 20, '...') }}</a>
                                    <div class="d-flex align-items-center justify-content-center mt-2">
                                        <h5>{{ $product->price }}</h5>
                                        {{-- <h6 class="text-muted ml-2"><del>$123.00</del></h6> --}}
                                    </div>
                                    <div class="d-flex align-items-center justify-content-center mb-1">
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small>(99)</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach


                    <div class="col-12">
                        <nav>
                            <ul class="pagination justify-content-center">
                                {{-- @if ($products->links('pagination::bootstrap-4')->previousPageUrl()== !null) --}}

                                {{ $products->links('pagination::bootstrap-4') }}

                                {{-- @endif --}}
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
            <!-- Shop Product End -->
        </div>
    </div>
    <!-- Shop End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>


@endsection
@section('page_title', 'Shop')
