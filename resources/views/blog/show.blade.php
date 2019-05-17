@extends('layouts.app')

@section('content')
    <!-- Page header -->
    <div class="page-top-section">
        <div class="overlay"></div>
        <div class="container text-right">
            <div class="page-info">
                <h2>Blog</h2>
                <div class="page-links">
                    <a href="/">Home</a>
                    <span>Blog</span>
                </div>
            </div>
        </div>
    </div>
    <!-- Page header end-->
    
    
    <!-- page section -->
    <div class="page-section spad">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-sm-7 blog-posts">
                    <!-- Single Post -->
                    <div class="single-post">
                        <div class="post-thumbnail">
                            <img src="/storage/uploads/{{$blog->image_name}}" alt="">
                            <div class="post-date">
                                <h2>{{$blog->created_at->format('d')}}</h2>
                                <h3>{{$blog->created_at->format('M Y')}}</h3>
                            </div>
                        </div>
                        <div class="post-content">
                            <h2 class="post-title">{{$blog->title}}</h2>
                            <div class="post-meta">
                                {{-- categories --}}
                                @if (count($blog->categories) !== 0)
                                    <span>
                                        @foreach ($blog->categories as $category)
                                            @if ($loop->last != $category)
                                                <a href="/blog/categories/{{$category}}">{{$category}}</a>, 
                                            @else
                                                <a href="/blog/categories/{{$category}}">{{$category}}</a>
                                            @endif
                                        @endforeach
                                    </span> 
                                @endif 

                                {{-- tags --}}
                                @if (count($blog->tags) !== 0)
                                    <span>
                                        @foreach ($blog->tags as $tag)
                                            @if ($loop->last != $tag)
                                                <a href="/blog/tags/{{$tag}}">{{$tag}}</a>, 
                                            @else
                                                <a href="/blog/tags/{{$tag}}">{{$tag}}</a>
                                            @endif
                                        @endforeach
                                    </span> 
                                @endif

                                {{-- comments --}}
                                <span>{{$blog->comments->count()}} {{str_plural('Comment', $blog->comments->count())}}</span>
                            </div>
                            <p>{{$blog->description}}</p>
                        </div>
                        <!-- Post Author -->
                        <div class="author">
                            <div class="avatar">
                                <img src="/storage/uploads/{{$blog->author()->image_name}}" alt="" style="width: 150px">
                            </div>
                            <div class="author-info">
                                <h2>{{$blog->author()->name}}, <span>Author</span></h2>
                                <p>{{$blog->author()->bio}}</p>
                            </div>
                        </div>
                        <!-- Post Comments -->
                        <div class="comments" id="comments">
                            <h2>{{str_plural('Comment', $blog->comments->count())}} ({{$blog->comments->count()}})</h2>
                            <ul class="comment-list">
                                @forelse ($blog->comments as $comment)
                                    <li>
                                        <div class="comment-text">
                                            <h3>{{$comment->name}} | {{$comment->created_at->format('d M y')}} | Reply</h3>
                                            <p>{{$comment->message}}</p>
                                        </div>
                                    </li>
                                @empty
                                    No comments yet
                                @endforelse
                            </ul>
                        </div>

                        <!-- Comment Form -->
                        <div class="row">
                            <div class="col-md-9 comment-form">
                                <h2>Leave a comment</h2>
                                <form class="form-class" method="post" action="/blog/{{$blog->id}}/comment">
                                    @csrf
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <input type="text" name="name" placeholder="Your name" required value="{{old('name')}}">
                                            @if ($errors->has('name'))
                                                <p class="bg-warning text-danger rounded text-center">{{$errors->first('name')}}</p>
                                            @endif
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="text" name="email" placeholder="Your email" required value="{{old('email')}}">
                                            @if ($errors->has('email'))
                                                <p class="bg-warning text-danger rounded text-center">{{$errors->first('email')}}</p>
                                            @endif
                                        </div>
                                        <div class="col-sm-12">
                                            <input type="text" name="subject" placeholder="Subject" required value="{{old('subject')}}">
                                            @if ($errors->has('subject'))
                                                <p class="bg-warning text-danger rounded text-center">{{$errors->first('subject')}}</p>
                                            @endif
                                            <textarea name="message" placeholder="Message" required>{{old('message')}}</textarea>
                                            @if ($errors->has('message'))
                                                <p class="bg-warning text-danger rounded text-center">{{$errors->first('message')}}</p>
                                            @endif
                                            <button class="site-btn">send</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Sidebar area -->
                @include('blog.sidebar')
            </div>
        </div>
    </div>
    <!-- page section end-->

    <style>
        .meta-lin:after {
            display: none !important;
        }
        .meta-link::after {
            display: none !important;
        }
    </style>
    
@endsection