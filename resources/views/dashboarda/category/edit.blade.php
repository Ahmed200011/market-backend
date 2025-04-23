@extends('dashboarda.layout.app')

@section('content')
    <form method="POST" action="{{ route('dashboard.Category.update', [$category->id]) }}" enctype="multipart/form-data">
        <div class="text-center">
            <img id="img-prevue" width="200" height="300" class=" img-thumbnail rounded-5 "
                src="{{ asset('dashboard/assets/images/categoryImage/'.$category->image ) }}" alt="">
        </div>
        @csrf
        @method('PUT')
        <div>
            <x-input-label for="name" class="form-label" :value="__('name')" />
            <x-text-input id="name" class="block mt-1 w-full form-control" type="text" name="category_name"
                value="{{ $category->category_name }}" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('category_name')" class="mt-2" />
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
        <button class="btn btn-primary w-100 py-8 fs-4 mb-4 mt-4 rounded-2">Edit</button>

    </form>
    <a href="{{ url()->previous() }}" class="btn btn-primary  py-8 fs-4 mb-4 mt-4 rounded-2">back</a>
@endsection
@section('page_title', 'Add User')
