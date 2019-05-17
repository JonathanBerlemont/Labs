@extends('layouts.admin')

@section('content') 

    <a href="/admin/blog/create" class="btn btn-default border-primary m-3">Create blog</a>
    @forelse ($blogs as $blog)
        <div class="border border-dark rounded m-3">
            <a href="/admin/blog/{{$blog->id}}" class="text-dark text-decoration-none">
                <div class="card-header">
                    <div class="d-flex">
                        <h2 style="flex:1"><strong>"{{$blog->title}}"</strong> created on {{$blog->created_at->format('d M Y')}} by <a href="">{{$blog->author()->name}}</a></h2>
                
                        {{-- Delete Button --}}
                        <form action="/admin/blog/{{$blog->id}}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn bn-default text-danger">X</button>    
                        </form>
                    </div>
                    <p class="mx-3 mt-3 mb-0">{{count($blog->comments)}} {{str_plural('Comment', count($blog->comments))}}</p>
                    
                </div>
                <div class="card-body">
                    <p>{{$blog->excerpt()}}</p>
                </div>
            </a>
        </div>
    @empty
        No blogs yet.
    @endforelse
@endsection