@extends('layouts.app')

@section('content')
    <!-- Page header -->
    <div class="page-top-section">
		<div class="overlay"></div>
		<div class="container text-right">
			<div class="page-info">
				<h2>Blog</h2>
				<div class="page-links">
					<a href="#">Home</a>
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
                @forelse ($blogs as $blog)
                    <!-- Post item -->
                    <div class="post-item">
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
                                @if (count($blog->categories))
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
                                @if (count($blog->tags))
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
                            <p>{{$blog->excerpt()}}</p>
                            <a href="{{$blog->path()}}" class="read-more">Read More</a>
                        </div>
                    </div>
                @empty
                    <p>Sorry, no blogs</p>
                @endforelse
                <!-- Pagination -->
					<div class="page-pagination">
                        {{$blogs->links()}}
                    </div>
                </div>

                <!-- Sidebar area -->
				@include('blog.sidebar')
            </div>
        </div>
    </div>
    <!-- page section end-->
@endsection