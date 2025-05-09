@extends('front.layout.app')
@section('content')


    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href={{ route('page.home') }}>Home</a>
                    <a class="breadcrumb-item text-dark" href={{ route('page.shop.index') }}>Shop</a>
                    <span class="breadcrumb-item active">Shopping Cart</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th>Products</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @foreach (Auth::user()->cart as $cartItem)
                            @foreach ($products as $product)
                                @if ($product->id == $cartItem->product_id)
                                    <form action="{{ route('page.cart.update', [$cartItem->id]) }}" method="post">
                                        @csrf
                                        @method('PUT')
                                        <tr>
                                            <td class="align-middle d-flex  align-items-center">
                                                <img @if (file_exists(public_path('dashboard/assets/images/products/' . $product->image))) src="{{ asset('dashboard/assets/images/products/' . $product->image) }}"
                                        @else
                                           src="{{ $product->image }}" @endif
                                                    alt="{{ $product->product_name }}" style="width: 50px;">
                                                <div class="ml-3">
                                                    {{ Str::limit($product->product_name, 20, '...') }}

                                                </div>
                                            </td>
                                            <td class="align-middle">${{ $cartItem->price }}</td>
                                            <td class="align-middle">

                                                <div class="input-group quantity mx-auto" style="width: 100px;">
                                                    <div class="input-group-btn">
                                                        <button class="btn btn-sm btn-primary btn-minus no">
                                                            <i class="fa fa-minus"></i>
                                                        </button>
                                                    </div>
                                                    <input type="text" name="quantity"
                                                        class="form-control form-control-sm bg-secondary border-0 text-center"
                                                        value="{{ $cartItem->quantity }}">
                                                    <div class="input-group-btn">
                                                        <button class="btn btn-sm btn-primary btn-plus no">
                                                            <i class="fa fa-plus"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <script>
                                                    document.querySelectorAll(".no").forEach(function(button) {
                                                        button.addEventListener("click", function(event) {
                                                            event.preventDefault();
                                                        });
                                                    });
                                                </script>
                                            </td>
                                            <td class="align-middle">${{ $cartItem->total }}</td>
                                            <td class="align-middle">
                                                <button type="submit" class="btn btn-sm btn-primary"><i
                                                        class="fa fa-edit"></i></button>
                                                <form action="{{ route('page.cart.destroy', $cartItem->id) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger"><i
                                                            class="fa fa-times"></i></button>

                                                </form>
                                            </td>
                                        </tr>
                                    </form>
                                @endif
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                {{-- <form class="mb-30" action="">
                    <div class="input-group">
                        <input type="text" class="form-control border-0 p-4" placeholder="Coupon Code">
                        <div class="input-group-append">
                            <button class="btn btn-primary">Apply Coupon</button>
                        </div>
                    </div>
                </form> --}}
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart
                        Summary</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Subtotal</h6>
                            <h6>${{ Auth::user()->cart()->sum('total') }}</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Shipping</h6>
                            <h6 class="font-weight-medium">$0</h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5>${{ Auth::user()->cart()->sum('total') + 0 }}</h5>
                        </div>
                        <button class="btn btn-block btn-primary font-weight-bold my-3 py-3">Proceed To Checkout</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->
    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>
@endsection
@section('page_title', 'Cart')
