@extends('dashboarda.layout.app')

@section('content')
    <form method="POST" action="{{ route('dashboard.user.update', [$user->id])  }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="text-center">
            <img id="img-prevue" width="200" height="300" class=" img-thumbnail rounded-5 "
                src="{{ asset('dashboard/assets/images/user_image/'.$user->image) }}" alt="">
        </div>

        <div>
            <x-input-label for="name" class="form-label" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full form-control" type="text" name="name"
                value="{{ $user->name }}" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" class="form-label" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full form-control" type="email" name="email"
                value="{{ $user->email }}" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" class="form-label" :value="__('Password')" />

            <x-text-input id="password" class="form-control" type="password" name="password"
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
            @foreach ($roles as $role)
                {{-- @foreach ($user->roles as $user_role) --}}
                    <div class="form-check">
                        <input class="form-check-input" type="radio" value="{{ $role->id }}"
                            @checked($user->hasRole($role->name)) name="role" id="flexCheckDefault.{{ $role->display_name }}">
                        <label class="form-check-label" for="flexCheckDefault.{{ $role->display_name }}">
                            {{ $role->display_name }}
                        </label>
                    </div>
                {{-- @endforeach --}}
            @endforeach
            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label class="form-label" :value="__('permissions')" />
            @foreach ($permissions as $permission)
                <div class="form-check">
                    {{-- @foreach ($user->permissions as $user_permission) --}}
                        <input class="form-check-input" type="checkbox" @checked($user->hasPermission($permission->name))
                            value="{{ $permission->id }}" name="permissions[]"
                            id="flexCheckDefault.{{ $permission->display_name }}">
                    {{-- @endforeach --}}
                    <label class="form-check-label" for="flexCheckDefault.{{ $permission->display_name }}">
                        {{ $permission->display_name }}
                    </label>
                </div>
            @endforeach

            <x-input-error :messages="$errors->get('permissions')" class="mt-2" />
        </div>

        <button class="btn btn-primary w-100 py-8 fs-4 mb-4 mt-4 rounded-2">Edit</button>

    </form>
    <a href="{{ url()->previous() }}" class="btn btn-primary  py-8 fs-4 mb-4 mt-4 rounded-2">back</a>
@endsection
@section('page_title', 'Add User')
