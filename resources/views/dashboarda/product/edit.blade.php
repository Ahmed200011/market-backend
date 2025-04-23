@extends('dashboarda.layout.app')

@section('content')
    <form method="POST" action="{{ route('dashboard.product.update', [$product->id])  }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="text-center">
            <img id="img-prevue" width="200" height="200" class=" img-thumbnail rounded-5 me-2"
                src="{{ asset('dashboard/assets/images/products/default_img.png') }}" alt="">
        </div>

        <div>
            <x-input-label for="product_name" class="form-label" :value="__('product_name')" />
            <x-text-input id="product_name" class="block mt-1 w-full form-control" type="text" name="product_name"
                value="{{$product->product_name}}" required autofocus autocomplete="product_name" />
            <x-input-error :messages="$errors->get('product_name')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="price" class="form-label" :value="__('price')" />
            <x-text-input id="price" class="block mt-1 w-full form-control" type="text" name="price"
                value="{{$product->price}}" required autofocus autocomplete="price" />
            <x-input-error :messages="$errors->get('price')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="description" class="form-label" :value="__('description')" />
            <x-text-input id="description" class="block mt-1 w-full form-control" type="text" name="description"
                value="{{$product->description}}" required autofocus autocomplete="description" />
            <x-input-error :messages="$errors->get('description')" class="mt-2" />
        </div>
        <div class="mt-4">
            <x-input-label for="image" class="form-label" :value="__('image')" />
            <input type="file" id="image" onchange="showPrevue(event)" class="block mt-1 w-full form-control"
                type="file" name="image">
            <x-input-error :messages="$errors->get('image')" class="mt-2" />
        </div>

        <script>
            function showPrevue(event) {
                if (event.target.files.length > 0) {
                    let src = URL.createObjectURL(event.target.files[0]);

                    var image = document.getElementById('img-prevue');
                    image.src = src;
                }
            }
        </script>

        <div class="mt-4">
            <x-input-label for="category_id" class="form-label" :value="__('old category ' .$old_category->category_name)" />
            <select name="category_id" id="category_id" class="block mt-1 w-full form-control">

                <option value="{{ $product->category_id }}">OLd Category {{ $product->category->category_name }}</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
        </div>

        <button class="btn btn-primary w-100 py-8 fs-4 mb-4 mt-4 rounded-2">Edit</button>

    </form>
    <a href="{{ url()->previous() }}" class="btn btn-primary  py-8 fs-4 mb-4 mt-4 rounded-2">back</a>
@endsection
@section('page_title', 'Add User')
