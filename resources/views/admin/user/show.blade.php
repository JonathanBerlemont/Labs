@extends('layouts.admin')

@section('content')

    <div class="pl-5">
        @include('flashMessage')
    </div>

    @if ((Auth::user() == $user))
        <form action="/admin/users/{{$user->id}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('patch')
    @elseif (Auth::user()->role == 'admin' && (Auth::user() != $user))
        <form action="/admin/users/{{$user->id}}/role" method="post">
            @csrf
            @method('patch')
    @endif
    
    {{-- Back Button --}}
    <div class="pl-5 pt-3">
        <a href="/admin/users" class="btn btn-dark ml-5">Back</a>
    </div>
    {{-- Content --}}
    <div class="row mx-5 mt-5 mb-2">
        {{-- Name --}}
        <div class="col-3 px-5">
            <div class="card">
                <div class="card-header">
                    Name:
                </div>
                <div class="card-body">
                    {{$user->name}}
                </div>
            </div>
        </div>

        {{-- Role --}}
        <div class="col-3 px-5">
            <div class="card">
                <div class="card-header">
                    Role:
                </div>
                <div class="card-body
                    {{($user->role == 'admin') ? 'text-danger': null }} 
                    {{($user->role == 'writer') ? 'text-primary' : null }}
                ">
                @if (Auth::user()->role == 'admin')
                    <select name="role" class="form-control">
                        <option selected hidden value="{{$user->role}}">
                            <p class="
                                {{($user->role == 'admin') ? 'text-danger': null }} 
                                {{($user->role == 'writer') ? 'text-primary' : null }}
                                ">
                                {{ucfirst($user->role)}}
                            </p>
                        </option>
                        <option value="admin" class="text-danger">Admin</option>
                        <option value="writer" class="text-primary">Writer</option>
                    </select>
                @else
                    {{$user->role}}
                    <input type="text" hidden value="{{$user->role}}" name="role">
                @endif
                </div>
            </div>
        </div>
    </div>
    <div class="row mx-5">
        {{-- Email --}}
        <div class="col-3 px-5">
            <div class="card">
                <div class="card-header">
                    Email:
                </div>
                <div class="card-body">
                    @if (Auth::user() == $user)
                        <input type="text" value="{{$user->email}}" style="border:0" name="email">
                    @else
                    {{$user->email}}
                    @endif
                </div>
            </div>
        </div>
        {{-- Profile Picture --}}
        <div class="col-3 px-5">
            <div class="card">
                <div class="card-header">
                    Profile Picture:
                </div>
                <div class="card-body text-center">
                    @if (Auth::user() == $user)
                        <label for="image"><img src="/storage/uploads/{{$user->image_name}}" alt="" style="width:200px"></label>
                        <input type="file" name="image" id="image" hidden>
                    @else
                    <img src="/storage/uploads/{{$user->image_name}}" alt="" style="width:200px">
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="row mx-5">
        {{-- Bio --}}
        <div class="col-6 p-5">
            <div class="card">
                <div class="card-header">
                    Bio:
                </div>
                <div class="card-body">
                    @if (Auth::user() == $user)
                        <textarea type="text" class="form-control" style="border:0" name="bio">{{$user->bio}}</textarea>
                    @else
                        {{$user->bio}}
                    @endif
                </div>
            </div>
        </div>
    </div>
    @if ($errors->any())
        <ul class="list-unstyled">
            @foreach ($errors->all() as $error)
                <li class="bg-warning text-danger">{{$error}}</li>
            @endforeach
        </ul>
    @endif

    @if ((Auth::user() == $user) || (Auth::user()->role == 'admin'))
    <div class="pl-5">
        <button type="submit" class="btn btn-primary ml-5">Update</button>
    </div>
    </form>
    @endif
@endsection