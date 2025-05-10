@extends('front.layout.app')
@section('content')

    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href={{ route('page.home') }}>Home</a>
                    <a class="breadcrumb-item text-dark" href={{ route('page.shop.index') }}>Shop</a>
                    <span class="breadcrumb-item active">Checkout</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->


    <!-- Checkout Start -->
    <div class="container-fluid">
        <form action="{{ route('page.payment.store') }}" method="post">
            @csrf
            <input name='user_id' value="{{ Auth::user()->id }}" type="hidden">
            @foreach ($usersAddresses as $user)
                <div class="row px-xl-5">
                    <div class="col-lg-8">
                        <h5 class="section-title position-relative text-uppercase mb-3"><span
                                class="bg-secondary pr-3">Billing
                                Address</span></h5>
                        <div class="bg-light p-30 mb-5">
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label>First Name</label>
                                    <input class="form-control" name='first_name' value="{{ $user->first_name }}"
                                        type="text" placeholder="John">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>Last Name</label>
                                    <input class="form-control" name='last_name' value="{{ $user->last_name }}"
                                        type="text" placeholder="Doe">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>E-mail</label>
                                    <input class="form-control" name='email' value="{{ $user->email }}" type="text"
                                        placeholder="example@email.com">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>Mobile No</label>
                                    <input class="form-control" name='mobile' value="{{ $user->mobile }}" type="text"
                                        placeholder="+123 456 789">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>Address Line 1</label>
                                    <input class="form-control" name='address1' value="{{ $user->address1 }}" type="text"
                                        placeholder="123 Street">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>Address Line 2</label>
                                    <input class="form-control" name='address2' value="{{ $user->address2 }}" type="text"
                                        placeholder="123 Street">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>Country</label>
                                    <select name="country" value=value="{{ $user->country }}" class="custom-select">
                                        <option value="United_States" selected>United States</option>
                                        <option value="Afghanistan">Afghanistan</option>
                                        <option value="Albania">Albania</option>
                                        <option value='Algeria'>Algeria</option>
                                    </select>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>City</label>
                                    <input class="form-control" name='city'value="{{ $user->city }}" type="text"
                                        placeholder="New York">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>State</label>
                                    <input class="form-control" name='state' value="{{ $user->state }}" type="text"
                                        placeholder="New York">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>ZIP Code</label>
                                    <input class="form-control" name='zip_code' value="{{ $user->zip_code }}"
                                        type="text" placeholder="123">
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-lg-4">
                        <h5 class="section-title position-relative text-uppercase mb-3"><span
                                class="bg-secondary pr-3">Order
                                Total</span></h5>
                        <div class="bg-light p-30 mb-5">
                            <div class="border-bottom">
                                <h6 class="mb-3">Products</h6>
                                @foreach ($cart as $item)
                                    @foreach ($products as $product)
                                        @if ($item->product_id == $product->id)
                                            <div class="d-flex justify-content-between">
                                                <p>{{ $product->product_name }}/{{$item->quantity}} </p>
                                                <p>{{ $item->price }}</p>
                                            </div>
                                        @endif
                                    @endforeach
                                @endforeach
                            </div>
                        </div>

                        <div class="border-bottom pt-3 pb-2">
                            <div class="d-flex justify-content-between mb-3">
                                <h6>Subtotal</h6>
                                <h6>${{ auth()->user()->cart()->sum('total') }}</h6>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h6 class="font-weight-medium">Shipping</h6>
                                <h6 class="font-weight-medium">$0</h6>
                            </div>
                        </div>
                        <div class="pt-2">
                            <div class="d-flex justify-content-between mt-2">
                                <h5>Total</h5>
                                <h5>$ {{ auth()->user()->cart()->sum('total') }}</h5>
                            </div>
                        </div>

                        <div class="mb-5">
                        </div>

                        <h5 class="section-title position-relative text-uppercase mb-3"><span
                                class="bg-secondary pr-3">Payment</span></h5>
                        <div class="bg-light p-30">
                            <div class="form-group">
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" name="payment" id="paypal">
                                    <label class="custom-control-label" for="paypal">Paypal</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" name="payment" id="directcheck">
                                    <label class="custom-control-label" for="directcheck">Direct Check</label>
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" name="payment" id="banktransfer">
                                    <label class="custom-control-label" for="banktransfer">Bank Transfer</label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-block btn-primary font-weight-bold py-3">Place
                                Order</button>
                        </div>
                    </div>
                </div>
    </div>
    @endforeach

    </form>
    </div>
    <!-- Checkout End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>


@endsection
@section('page_title', 'Checkout')
