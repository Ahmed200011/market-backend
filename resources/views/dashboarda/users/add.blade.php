@extends('dashboarda.layout.app')

@section('content')


    <form method="POST" action="{{ route('dashboard.user.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="text-center">
            <img id="img-prevue" width="200" height="200" class=" img-thumbnail rounded-5 me-2"
                src="{{ asset('dashboard/assets/images/profile/default.jpg') }}" alt="">
        </div>
        <div>
            <x-input-label for="name" class="form-label" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full form-control" type="text" name="name"
                :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" class="form-label" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full form-control" type="email" name="email"
                :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" class="form-label" :value="__('Password')" />

            <x-text-input id="password" class="form-control" type="password" name="password" required
                autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
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
            <x-input-label class="form-label" :value="__('roles')" />
            {{-- @dd($roles) --}}
            @foreach ($roles as $role)
                <div class="form-check">
                    <input class="form-check-input" type="radio" value="{{ $role->id }}" name="role"
                        id="flexCheckDefault.{{ $role->display_name }}">
                    <label class="form-check-label" for="flexCheckDefault.{{ $role->display_name }}">
                        {{ $role->display_name }}
                    </label>
                </div>
            @endforeach
        </div>
            <div class="mt-4">
                <x-input-label class="form-label" :value="__('permissions')" />
                @foreach ($permissions as $permission)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="{{ $permission->id }}" name="permissions[]"
                            id="flexCheckDefault.{{ $permission->display_name }}">
                        <label class="form-check-label" for="flexCheckDefault.{{ $permission->display_name }}">
                            {{ $permission->display_name }}
                        </label>
                    </div>
                @endforeach

                <x-input-error :messages="$errors->get('permissions')" class="mt-2" />
            </div>



            <a href="{{ url()->previous() }}" class="btn btn-secondary  py-8 fs-4 m-4   rounded-2">
                {{ __('Back') }}</a>
            <button class="btn btn-primary  py-8 fs-4 m-4   rounded-2">{{ __('Add user') }}</button>

    </form>
@endsection
@section('page_title', 'Add User')
