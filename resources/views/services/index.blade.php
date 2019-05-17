@extends('layouts.app')

@section('content')
    <!-- Page header -->
    <div class="page-top-section">
        <div class="overlay"></div>
        <div class="container text-right">
          <div class="page-info">
            <h2>Services</h2>
            <div class="page-links">
              <a href="#">Home</a>
              <span>Services</span>
            </div>
          </div>
        </div>
      </div>
      <!-- Page header end-->
    
    
    <!-- services section -->
    <div class="services-section spad">
        <div class="container">
            <div class="section-title dark">
                <h2>Get in <span>the Lab</span> and see the services</h2>
            </div>
            <div class="row">
                
                @forelse ($services as $service)
                    <!-- single service -->
                    @include('services.service')
                @empty
                    <p class="text-center w-100">No Services Available</p>
                @endforelse
                
            </div>
            <div class="text-center">
                {{$services->links()}}
            </div>
        </div>
    </div>
      <!-- services section end -->
    
    
        <!-- features section -->
        <div class="team-section spad">
            <div class="overlay"></div>
                <div class="container">
                    <div class="section-title">
                        <h2>Get in <span>the Lab</span> and discover the world</h2>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-sm-4 features">
                            @forelse ($first_projects as $project)
                                <!-- feature item -->
                                @include('services.feature')
                            @empty
                                No features yet
                            @endforelse
                        </div>
                        <!-- Devices -->
                        <div class="col-md-4 col-sm-4 devices">
                            <div class="text-center">
                            <img src="/img/device.png" alt="">
                            </div>
                        </div>
                        <!-- feature item -->
                        <div class="col-md-4 col-sm-4 features">
                            @forelse ($second_projects as $project)
                                <!-- feature item -->
                                @include('services.feature2')
                            @empty
                                No features yet
                            @endforelse
                        </div>
                    </div>
                    <div class="text-center mt100">
                        <a href="#scroll" class="site-btn" style="">Browse</a>
                    </div>
                </div>
            </div>
        </div>
      <!-- features section end-->
    
    
      <!-- services card section-->
      <div class="services-card-section spad" id="scroll">
        <div class="container">
          <div class="row">
            <!-- Single Card -->
            
            @forelse ($projects_show as $project)
                <div class="col-md-4 col-sm-6">
                    <div class="sv-card">
                        <div class="card-img">
                            <img src="/storage/uploads/{{$project->image_name}}" alt="">
                        </div>
                        <div class="card-text">
                            <h2>{{$project->title}}</h2>
                            <p>{{$project->description}}</p>
                        </div>
                    </div>
                </div>
            @empty
                
            @endforelse
          </div>
        </div>
      </div>
      <!-- services card section end-->
    
    
      @include('newsletter')
    
    
     @include('contact_info')
    
      @include('footer')
@endsection