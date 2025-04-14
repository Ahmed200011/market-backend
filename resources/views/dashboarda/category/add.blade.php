@extends('dashboarda.layout.app')

@section('content')
    <form method="POST" action="{{ route('dashboard.Category.store') }}">
        @csrf
           <div>
            <x-input-label for="name" class="form-label" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full form-control" type="text" name="category_name"
                :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>
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

            <x-input-error :messages="$errors->get('permissions')" class="mt-2" />
        </div>
        <div class="mt-4">
            <a href="{{ url()->previous() }}" class="btn btn-secondary  py-8 fs-4 m-4   rounded-2">
                {{ __('Back') }}</a>
            <button class="btn btn-primary  py-8 fs-4 m-4   rounded-2">{{ __('Add Category') }}</button>

    </form>
@endsection
@section('page_title', 'Add Category')
