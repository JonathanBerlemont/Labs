@extends('layouts.admin')

@section('content')
    
    <div class="row m-0 p-0" style="overflow:hidden">
        {{-- Title and Body --}}
        <div class="col-9 border-right border-muted" style="height: 100vh; overflow-y: scroll">
            {{-- Flash Message --}}
            @if ($message = Session::get('success'))    
                <div id="flashMessage" class="alert-success p-3 mt-3 rounded">
                    <h4>{{$message}}</h4>
                </div>  
                <script>
                    setTimeout( () => {
                        document.querySelector('#flashMessage').remove();
                    }, 3000)
                </script>      
            @endif
            
            <div class="d-flex">
                {{-- View Button --}}
                <div class="mt-3">
                    <a href="/blog/{{$blog->id}}" class="btn btn-primary">
                        View Blog
                    </a>
                </div>
                {{-- Delete Button --}}
                <form action="/admin/blog/{{$blog->id}}" method="post" class="mt-3">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger ml-3">Delete Blog</button>    
                </form>
            </div>
            
            <form action="/admin/blog/{{$blog->id}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('patch')

                <div class="card mt-3">
                    <div class="card-header"><h3>Title and Body</h3></div>
                        <div class="card-body p-3">
                            <h1><input type="text" name="title" value="{{$blog->title}}" style="border: 0; width:100%;"></h1>
                            <div class="d-flex">
                                <div><strong>Created</strong> on {{$blog->created_at->format('d M Y')}} <strong>by</strong> {{$blog->author()->name}}</div>
                            </div>
                            <hr>

                            <div class="card rounded p-2">
                                <textarea name="description" id="description" cols="30" rows="5" style="border:0" onkeyup="auto_grow(this)">{{$blog->description}}</textarea>
                            </div>
                        
                        @if ($errors->any())
                            <ul class="list-unstyled">
                                @foreach ($errors->all() as $error)
                                    <li class="bg-warning text-danger">{{$error}}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>

                {{-- Categories and Tags --}}
                <div class="card mt-4">
                    <div class="card-header"><h3>Categories and Tags</h3></div>
                    <div class="card-body p-3">
                        <table>
                            <tr>
                                <td class="text-right"><strong>Categories</strong>:</td> 
                                <td><input type="text" name="categories" value="{{implode(', ', $blog->categories)}}" class="ml-3" style="border:0; width: 500px"></td>
                            </tr>
                        
                            <tr>
                                <td class="text-right"><strong>Tags</strong>:</td> 
                                <td><input type="text" name="tags" value="{{implode(', ', $blog->tags)}}" class="ml-3" style="border:0; width: 500px"></td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="card mt-4">
                    <div class="card-header">
                        <h3>Banner</h3>
                    </div>
                    <div class="card-body p-3">
                        <input type="file" name="image" id="" class="form-control">
                        <img src="/storage/uploads/{{$blog->image_name}}" alt="" style="width: 200px" class="mt-2">
                    </div>
                </div>

                <div class="card p-3 my-4">
                    <button type="submit" class="btn btn-primary mx-auto" style="width: 100px">Update</button>
                </div>

                
            </form>
        </div>

        {{-- Comments --}}
        <div class="col-3 fixed p-0 border-right" style="height: 100vh">
            <h3 class="text-center mt-1 card-header">Comments ({{count($blog->comments)}})</h3>
            <div style="overflow-y: scroll; height: 95vh">
                @forelse ($blog->comments as $comment)
                <div class="border border-black rounded m-3">
                    <div class="card-header">
                        <div class=" d-flex">
                            <p style="flex:1">{{$comment->name}}</p>
                            <form action="/comments/{{$comment->id}}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-default text-danger">X</button>
                            </form>
                        </div>
                        <p class="mb-0">{{$comment->created_at->format('d M Y')}}</p>
                    </div>
                    <div class="card-body">{{$comment->message}}</div>
                </div>
                @empty
                <p class="mt-5 text-center">No comments yet</p>
                @endforelse
            </div>
        </div>
    </div>

    <script>
        function auto_grow(element) {
            element.style.height = "5px";
            element.style.height = (element.scrollHeight)+"px";
        }
    </script>

    <style>
        /* width */
        ::-webkit-scrollbar {
        width: 0px;
        }

        /* Track */
        ::-webkit-scrollbar-track {
        background: $light; 
        }

        /* Handle */
        ::-webkit-scrollbar-thumb {
        background: none; 
        }

        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
        background: none; 
        }
    </style>
@endsection