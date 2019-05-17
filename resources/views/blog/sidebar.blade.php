<div class="col-md-4 col-sm-5 sidebar">
    <!-- Single widget -->
    <div class="widget-item">
        <form action="/blog/search" method="post" class="search-form">
            @csrf
            <input type="text" placeholder="Search" name="query">
            <button class="search-btn"><i class="flaticon-026-search"></i></button>
        </form>
    </div>
    <!-- Single widget -->
    <div class="widget-item">
        <h2 class="widget-title">Categories</h2>
        <ul>
            @foreach (App\Category::inRandomOrder()->limit(5)->get() as $category)
                <li><a href="/blog/categories/{{$category->name}}">{{$category->name}}</a></li>
            @endforeach
        </ul>
    </div>
    <!-- Single widget -->
    <div class="widget-item">
        <h2 class="widget-title">Instagram</h2>
        <ul class="instagram">
            <li><img src="/img/instagram/1.jpg" alt=""></li>
            <li><img src="/img/instagram/2.jpg" alt=""></li>
            <li><img src="/img/instagram/3.jpg" alt=""></li>
            <li><img src="/img/instagram/4.jpg" alt=""></li>
            <li><img src="/img/instagram/5.jpg" alt=""></li>
            <li><img src="/img/instagram/6.jpg" alt=""></li>
        </ul>
    </div>
    <!-- Single widget -->
    <div class="widget-item">
        <h2 class="widget-title">Tags</h2>
        <ul class="tag">
            @foreach (App\Tag::inRandomOrder()->limit(10)->get() as $tag)
                <li><a href="/blog/tags/{{$tag->name}}">{{$tag->name}}</a></li>
            @endforeach
        </ul>
    </div>
    <!-- Single widget -->
    <div class="widget-item">
        <h2 class="widget-title">Quote</h2>
        <div class="quote">
            <span class="quotation">‘​‌‘​‌</span>
            <p>{{App\Testimonial::inRandomOrder()->take(1)->first()->message}}</p>
        </div>
    </div>
    <!-- Single widget -->
    <div class="widget-item">
        <h2 class="widget-title">Add</h2>
        <div class="add">
            <a href=""><img src="/img/add.jpg" alt=""></a>
        </div>
    </div>
</div>