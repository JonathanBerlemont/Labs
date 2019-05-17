@extends('layouts.admin')

@section('content')
    <form action="/admin/team/{{$member->id}}" method="post" enctype="multipart/form-data">  
        @csrf
        @method('patch')
        <div class="card m-5 w-25">
            <div class="card-header">
                <h3 class="text-center"><input type="text" name="name" value="{{$member->name}}" class="text-center" style="border:0"></h3>
            </div>
            <div class="card-body p-3 text-center">
                <label for="image"><img src="/storage/uploads/{{$member->image_name}}" alt="" style="width: 200px"></label>
                <input type="file" name="image" id="image" class="form-control" hidden>
                <div>
                    <strong>Job: </strong>
                    <input type="text" name="job" class="mt-3" value="{{$member->job}}" style="border:0">
                </div>
                <button type="submit" class="btn btn-primary mt-4">Update</button>
            </div>
        </div>

    </form>
    @if ($errors->any())
            <ul class="list-unstyled">
                @foreach ($errors->all() as $error)
                    <li class="bg-warning text-danger">{{$error}}</li>
                @endforeach
            </ul>
        @endif
@endsection