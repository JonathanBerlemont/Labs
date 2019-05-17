@extends('layouts.admin')

@section('content')

    @include('flashMessage')

    {{-- Users Table --}}
    <div class="card m-5">
        <div class="card-header">
            <div class="d-flex">
                <h2 class="px-3 pt-3" style="flex:1">Users</h2>
                @can('view', App\User::class)   
                <div class="d-flex align-items-center">
                    <a href="/admin/users/create" class="btn btn-primary">Add User</a>
                </div>
                @endcan
            </div>
        </div>
        <div class="card-body p-0">
            <div class="border-bottom">
                <div class="row text-center">
                    <div class="col-2 border-right px-3 py-1 text-muted"><strong>Name</strong></div>
                    <div class="col-2 border-right px-3 py-1 text-muted"><strong>Role</strong></div>
                    <div class="col-2 border-right px-3 py-1 text-muted"><strong>Email</strong></div>
                </div>
            </div>
            @foreach ($users as $user)
                {{-- User Info and Handling --}}
                <div class=" border-bottom">
                    <div class="row text-center">
                        {{-- Name --}}
                        <div class="col-2 border-right p-3">{{$user->name}}</div>
                        {{-- Role --}}
                        <div class="col-2 border-right p-3 
                            {{($user->role == 'admin') ? 'text-danger': null }} 
                            {{($user->role == 'writer') ? 'text-primary' : null }}">
                            <p id="role-edit-{{$user->id}}-base" class="p-0 m-0">{{ucfirst($user->role)}}</p>
                            {{-- Edit Role --}}
                            <form action="/admin/users/{{$user->id}}/role" method="post" id="role-edit-{{$user->id}}" class="d-none w-50 mx-auto">
                                @csrf
                                @method('patch')
                                <select name="role" class="form-control" onchange="this.form.submit()">
                                    <option disabled selected hidden><p class="text-muted">{{ucfirst($user->role)}}</p></option>
                                    <option value="admin">Admin</option>
                                    <option value="writer">Writer</option>
                                </select>
                            </form>
                        </div>
                        {{-- Email --}}
                        <div class="col-2 border-right p-3">{{$user->email}}</div>

                        {{-- Controls --}}
                        <div class="col-6 text-right d-flex justify-content-end">
                            <div class="d-flex align-items-center">
                                {{-- View Profile Button --}}
                                <a href="/admin/users/{{$user->id}}" class="btn btn-success mr-3">VIEW PROFILE</a>

                                {{-- Edit Role Button --}}
                                @can('view', App\User::class)
                                <a onclick="viewEdit('{{$user->id}}')" class="btn btn-warning mr-3">EDIT ROLE</a>

                                {{-- Delete Profile Button --}}
                                <form action="/admin/users/{{$user->id}}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger mr-3">DELETE ACCOUNT</button>
                                </form>
                                @endcan
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script>
        function viewEdit(name) {
            document.querySelector(`#role-edit-${name}`).classList.toggle('d-none');
            document.querySelector(`#role-edit-${name}-base`).classList.toggle('d-none');
        }
    </script>
@endsection