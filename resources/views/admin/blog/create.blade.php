@extends('layouts.admin')

@section('content')

    <a href="/admin/blog" class="btn btn-dark my-3">Back</a>
    <h1>Write a new blog</h1>

    <div class="card" >
        <form action="/admin/blog" method="post" class="px-5 py-3" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-8 d-flex flex-column">
                    <label for="title">Title</label>
                    <input type="title" placeholder="Title" name="title" class="form-control mb-4">
                    @if ($errors->has('title'))
                        <p class="bg-warning text-danger">{{$errors->first('title')}}</p>
                    @endif
            
                    <label for="description">Text</label>
                    <textarea name="description" id="description" cols="30" rows="10" placeholder="Text" class="mb-4 form-control"></textarea>
                    @if ($errors->has('description'))
                        <p class="bg-warning text-danger">{{$errors->first('description')}}</p>
                    @endif
                </div>
                <div class="col-4 border-left border-muted d-flex flex-column">
                    <label for="categories">Categories</label>
                    <input type="text" placeholder="Categories" name="categories" class="form-control">
                    
                    <label for="tags" class="mt-4">Tags</label>
                    <input type="text" placeholder="Tags" name="tags" class="form-control mb-4">

                    <label for="image">Banner</label>
                    <input type="file" name="image" id="" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary w-50 mx-auto mt-5">Create</button>
            </div>
        </form>
    </div>

@endsection