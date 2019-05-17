@extends('layouts.app')

@section('content')  
  <!-- Intro Section -->
  <div class="hero-section">
    <div class="hero-content">
      <div class="hero-center">
        <img src="/img/big-logo.png" alt="">
        <p>Get your freebie template now!</p>
      </div>
    </div>


    <!-- slider -->
    <div id="hero-slider" class="owl-carousel">
      <div class="item  hero-item" data-bg="/img/01.jpg"></div>
      <div class="item  hero-item" data-bg="/img/02.jpg"></div>
    </div>
  </div>
  <!-- Intro Section -->


  <!-- About section -->
  <div class="about-section">
    <div class="overlay"></div>
    <!-- card section -->
    <div class="card-section">
      <div class="container">
        <div class="row">
          @foreach (App\Project::inRandomOrder()->take(3)->get() as $project)
              @include('project')
          @endforeach
        </div>
      </div>
    </div>
    <!-- card section end-->
    

    <!-- About content -->
    <div class="about-content">
      <div class="container">
        <div class="section-title">
          <h2>Get in <span>the Lab</span> and discover the world</h2>
        </div>
        <div class="row">
          <div class="col-md-6">
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur leo est, feugiat nec elementum id, suscipit id nulla. Nulla sit amet luctus dolor. Etiam finibus consequat ante ac congue. Quisque porttitor porttitor tempus. Donec maximus ipsum non ornare vporttitor porttitorestibulum. Sed libero nibh, feugiat at enim id, bibendum sollicitudin arcu.</p>
          </div>
          <div class="col-md-6">
            <p>Cras ex mauris, ornare eget pretium sit amet, dignissim et turpis. Nunc nec maximus dui, vel suscipit dolor. Donec elementum velit a orci facilisis rutrum. Nam convallis vel erat id dictum. Sed ut risus in orci convallis viverra a eget nisi. Aenean pellentesque elit vitae eros dignissim ultrices. Quisque porttitor porttitorlaoreet vel risus et luctus.</p>
          </div>
        </div>
        <div class="text-center mt60">
          <a href="" class="site-btn">Browse</a>
        </div>
        <!-- popup video -->
        <div class="intro-video">
          <div class="row">
            <div class="col-md-8 col-md-offset-2">
              <img src="img/video.jpg" alt="">
              <a href="https://www.youtube.com/watch?v=JgHfx2v9zOU" class="video-popup">
                <i class="fa fa-play"></i>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- About section end -->


  <!-- Testimonial section -->
  <div class="testimonial-section pb100">
    <div class="test-overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-md-8 col-md-offset-4">
          <div class="section-title left">
            <h2>What our clients say</h2>
          </div>
          <div class="owl-carousel" id="testimonial-slide">
            @foreach (App\Testimonial::take(5)->get() as $testimonial)
                @include('testimonial')
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Testimonial section end-->


  <!-- Services section -->
  <div class="services-section spad">
    <div class="container">
      <div class="section-title dark">
        <h2>Get in <span>the Lab</span> and see the services</h2>
      </div>
      <div class="row">
        @foreach (App\Service::take(9)->get() as $service)
            @include('services.service')
        @endforeach
      </div>
  </div>
  <!-- services section end -->


  <!-- Team Section -->
  <div class="team-section spad">
    <div class="overlay"></div>
    <div class="container">
      <div class="section-title">
        <h2>Get in <span>the Lab</span> and meet the team</h2>
      </div>
      <div class="row">
        @include('team')
      </div>
    </div>
  </div>
  <!-- Team Section end-->


  <!-- Promotion section -->
  <div class="promotion-section">
    <div class="container">
      <div class="row">
        <div class="col-md-9">
          <h2>Are you ready to stand out?</h2>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur leo est.</p>
        </div>
        <div class="col-md-3">
          <div class="promo-btn-area">
            <a href="" class="site-btn btn-2">Browse</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Promotion section end-->


  @include('contact_info')

  @include('footer')

@endsection