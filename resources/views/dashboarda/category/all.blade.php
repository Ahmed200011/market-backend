@extends('dashboarda.layout.app')

@section('content')
    <div class="card w-100">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between">

                <h5 class="card-title fw-semibold text-center">All Categories</h5>
                <a href="{{ route('dashboard.Category.create') }}" type="button" class="btn btn-outline-secondary m-1">Add
                    Category</a>
            </div>
            <div class="table-responsive">
                <table class="table text-nowrap mb-0 align-middle">
                    <thead class="text-dark fs-4">
                        <tr>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Id</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">image</h6>
                            </th>

                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Category_name</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Parent_name</h6>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $key => $category)
                            <tr>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">{{ $key + 1 }}</h6>
                                </td>
                                <td class="border-bottom-0 d-flex">
                                    <img width="50" height="50" class=" border rounded-circle me-2"
                                        src="{{ asset('dashboard/assets/images/categoryImage/'.$category->image) }}" alt="">
                                </td>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-1">{{ $category->category_name }}</h6>
                                </td>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-1">{{ $category?->parent->category_name }}</h6>
                                </td>
                                <td class="border-bottom-0 d-flex">
                                    <a href="{{ route('dashboard.Category.edit', $category->id) }}" type="button"
                                        class="btn btn-outline-success m-1">Edit</a>
                                    <form action="{{ route('dashboard.Category.destroy', [$category->id]) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-outline-danger m-1">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $categories->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>

    {{-- </div> --}}

@endsection
@section('page_title', 'All Categories')
