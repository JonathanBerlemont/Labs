@extends('layouts.admin')

@section('content')
    <a href="/admin/team" class="btn btn-dark mt-5 mx-5">Back</a>
    <div class="card m-5 w-50">
        <div class="card-header">
            <h2>Create a new team member</h2>
        </div>
        <div class="card-body">
            <form action="/admin/team" method="post" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-6">
                        <input type="text" name="name" class="form-control" placeholder="Name">
                    </div>
                    <div class="col-6">
                        <input type="text" name="job" class="form-control" placeholder="Job">
                    </div>
                    <div class="w-100 m-3">
                        <input type="file" name="image" class="form-control w-100">
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Add Member</button>
            </form>

            @if ($errors->any())
                <ul class="list-unstyled">
                    @foreach ($errors->all() as $error)
                        <li class="bg-warning text-danger">{{$error}}</li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
@endsection