@extends('layouts.admin')

@section('content')
    <div class="pt-3">
        <a href="/admin/users" class="btn btn-dark ml-5">Back</a>
    </div>

    <div class="card m-5">
        <div class="card-header">
            <h2>Add a new user</h2>
        </div>
        <div class="card-body">
            <form action="/admin/users/create" method="post" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-6">
                        <input type="text" placeholder="Name" class="form-control" name="name">
                        @if ($errors->has('name'))
                            <p class="bg-warning text-danger">{{$errors->first('name')}}</p>
                        @endif
                    </div>
                    <div class="col-6">
                        <input type="email" placeholder="Email" class="form-control" name="email">
                        @if ($errors->has('email'))
                            <p class="bg-warning text-danger">{{$errors->first('email')}}</p>
                        @endif
                    </div>
                </div>
                <div class="row my-3">
                    <div class="col-6">
                        <select name="role" id="" class="form-control">
                            <option disabled selected hidden><p class="text-muted">Role</p></option>
                            <option value="admin">Admin</option>
                            <option value="writer">Writer</option>
                        </select>
                        @if ($errors->has('role'))
                            <p class="bg-warning text-danger">{{$errors->first('role')}}</p>
                        @endif
                    </div>
                    <div class="col-6">
                        <input type="password" placeholder="Password" class="form-control" name="password">
                        @if ($errors->has('password'))
                            <p class="bg-warning text-danger">{{$errors->first('password')}}</p>
                        @endif
                    </div>
                </div>
                <div class="row mb-3">
                   <div class="col-6">
                        <input type="file" name="image" id="" class="form-control">
                   </div>
                </div>
                
                <textarea name="bio" id="bio" cols="30" rows="10" placeholder="Bio" class="form-control"></textarea>
                @if ($errors->has('bio'))
                    <p class="bg-warning text-danger">{{$errors->first('bio')}}</p>
                @endif
                <button type="submit" class="btn btn-primary mt-5">Add User</button>
            </form>
        </div>
    </div>
@endsection