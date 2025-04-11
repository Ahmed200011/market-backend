@extends('dashboarda.layout.app')

@section('content')
    {{-- <div class="col-lg-8 d-flex align-items-stretch"> --}}
    <div class="card w-100">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between">

                <h5 class="card-title fw-semibold text-center">All Users</h5>
                <a href="{{ route('dashboard.user.create') }}" type="button" class="btn btn-outline-secondary m-1">Add
                    User</a>
            </div>
            <div class="table-responsive">
                <table class="table text-nowrap mb-0 align-middle">
                    <thead class="text-dark fs-4">
                        <tr>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Id</h6>
                            </th>

                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">User Data</h6>
                            </th>

                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Role</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Permissions</h6>

                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Action</h6>
                            </th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($data as $key => $user)
                        {{-- @dd($user) --}}
                            <tr>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">{{ $key + 1 }}</h6>
                                </td>


                                <td class="border-bottom-0 d-flex">
                                    <img width="50" height="50" class=" border rounded-circle me-2"
                                        src="{{ asset('dashboard/assets/images/user_image/'.$user->image) }}" alt="">
                                    <div>
                                        <h6 class="fw-semibold mb-1">{{ $user->name }}</h6>
                                        <p class="mb-0 fw-normal">{{ $user->email }}</p>
                                    </div>

                                </td>

                                {{-- <div class=""> --}}
                                {{-- <img width="50" height="50" src="{{asset('dashboard/assets/images/profile/default.jpg')}}" alt=""> --}}
                                {{-- <div>
                                            <h6>Brandon Washington</h6>
                                            <p>Head admin</p>
                                        </div> --}}
                                {{-- </div> --}}






                                <td class="border-bottom-0">
                                    <div class="d-flex align-items-center gap-2">
                                        @foreach ($user->roles as $role)
                                            <span
                                                class="badge bg-primary rounded-3 fw-semibold">{{ $role->display_name }}</span>
                                        @endforeach
                                    </div>
                                </td>

                                <td class="border-bottom-0">
                                    <div class="d-flex align-items-center gap-2">

                                        <select class="form-control form-control-lg">
                                            {{-- @foreach ($user->roles as $role)
                                                @foreach ($role->permissions as $permission)
                                                    <option class="">
                                                        {{ $permission->name }}</option>
                                                @endforeach
                                            @endforeach --}}

                                            @foreach ($user->allPermissions() as $permission)
                                                <option class="">
                                                    {{ $permission->name }}</option>
                                            @endforeach

                                        </select>




                                    </div>
                                </td>

                                <td class="border-bottom-0 d-flex">
                                    <a href="{{ route('dashboard.user.edit', $user->id) }}" type="button"
                                        class="btn btn-outline-success m-1">Edit</a>

                                        {{-- <form action={{ route('dashboard.user.destroy', [$user->id]) }} method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="card-link btn btn-danger">Delete</button>
                                        </form> --}}

                                    <form action="{{ route('dashboard.user.destroy', $user->id) }}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <button class="btn btn-outline-danger m-1">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $data->links('pagination::bootstrap-5') }}



            </div>
        </div>
    </div>

    {{-- </div> --}}

@endsection
@section('page_title', 'All User')
