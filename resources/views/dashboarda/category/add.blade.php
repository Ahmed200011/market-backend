@extends('dashboarda.layout.app')

@section('content')
    <form method="POST" action="{{ route('dashboard.Category.store') }} " enctype="multipart/form-data">
        @csrf
        <div class="text-center">
            <img id="img-prevue" width="200" height="200" class=" img-thumbnail rounded-5 me-2"
                src="{{ asset('dashboard/assets/images/categoryImage/default.png') }}" alt="">
        </div>
           <div>
            <x-input-label for="name" class="form-label" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full form-control" type="text" name="category_name"
                :value="old('name')" required autofocus autocomplete="name" />
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
        <div class="mt-4">
            <x-input-label class="form-label" :value="__('parent')" />
            @foreach ($parents as $parent)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="{{ $parent->id}}" name="parent_id"
                        id="flexCheckDefault.{{ $parent->category_name}}">
                    <label class="form-check-label" for="flexCheckDefault.{{ $parent->category_name}}">
                        {{ $parent->category_name}}
                    </label>
                </div>
            @endforeach

            <x-input-error :messages="$errors->get('parent')" class="mt-2" />
        </div>
        <div class="mt-4">
            <a href="{{ url()->previous() }}" class="btn btn-secondary  py-8 fs-4 m-4   rounded-2">
                {{ __('Back') }}</a>
            <button class="btn btn-primary  py-8 fs-4 m-4   rounded-2">{{ __('Add Category') }}</button>

    </form>
@endsection
@section('page_title', 'Add Category')
