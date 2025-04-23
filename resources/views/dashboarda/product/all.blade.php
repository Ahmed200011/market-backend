@extends('dashboarda.layout.app')

@section('content')
    {{-- <div class="col-lg-8 d-flex align-items-stretch"> --}}
    <div class="card w-100">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between">

                <h5 class="card-title fw-semibold text-center">All Products</h5>
                <a href="{{ route('dashboard.product.create') }}" type="button" class="btn btn-outline-secondary m-1">Add
                    product</a>
            </div>
            <div class="table-responsive">
                <table class="table text-nowrap mb-0 align-middle">
                    <thead class="text-dark fs-4">
                        <tr>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Id</h6>
                            </th>

                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">product Data</h6>
                            </th>

                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">description</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">price</h6>

                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Action</h6>
                            </th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($products as $key => $product)
                            {{-- @dd($user) --}}
                            <tr>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">{{ $key + 1 }}</h6>
                                </td>


                                <td class="border-bottom-0 d-flex">
                                    <img width="50" height="50" class=" border rounded-circle me-2"
                                    @if (file_exists(public_path('dashboard/assets/images/products/' . $product->image)))
                                        src="{{ asset('dashboard/assets/images/products/' . $product->image) }}"

                                    @endif
                                        src="{{$product->image}}"
                                        alt="{{$product->product_name}}">
                                    <div>
                                        <h6 class="fw-semibold mb-1">{{ $product->product_name }}</h6>
                                        <p class="mb-0 fw-normal">{{ $product->category->category_name }}</p>
                                    </div>

                                </td>
                                <td class="border-bottom-0">
                                    <div class="d-flex align-items-center gap-2">
                                        <h6 class="fw-semibold mb-0"> {{ $product->description }} </h6>
                                    </div>
                                </td>

                                <td class="border-bottom-0">
                                    <div class="d-flex align-items-center gap-2">
                                        <h6 class="fw-semibold mb-0"> {{ $product->price }}$ </h6>
                                    </div>
                                </td>

                                <td class="border-bottom-0 d-flex">
                                    <a href="{{ route('dashboard.product.edit', $product->id) }}" type="button"
                                        class="btn btn-outline-success m-1">Edit</a>

                                    <form action="{{ route('dashboard.product.destroy', $product->id) }}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <button class="btn btn-outline-danger m-1">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $products->links('pagination::bootstrap-5') }}



            </div>
        </div>
    </div>

    {{-- </div> --}}

@endsection
@section('page_title', 'All products')
