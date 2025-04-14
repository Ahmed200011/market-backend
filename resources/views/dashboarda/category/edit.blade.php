@extends('dashboarda.layout.app')

@section('content')
    <form method="POST" action="{{ route('dashboard.Category.update', [$category->id]) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div>
            <x-input-label for="name" class="form-label" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full form-control" type="text" name="name"
                value="{{ $category->name }}" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>
        <button class="btn btn-primary w-100 py-8 fs-4 mb-4 mt-4 rounded-2">Edit</button>

    </form>
    <a href="{{ url()->previous() }}" class="btn btn-primary  py-8 fs-4 mb-4 mt-4 rounded-2">back</a>
@endsection
@section('page_title', 'Add User')
