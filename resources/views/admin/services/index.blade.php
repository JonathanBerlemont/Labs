@extends('layouts.admin')

@section('content')
    @include('flashMessage')
    <a href="/admin/services/create" class="btn btn-default border-primary m-3">Create service</a>
    @forelse ($services as $service)
        <div class="border border-dark rounded m-3">
            <a href="/admin/services/{{$service->id}}" class="text-dark text-decoration-none">
                <div class="d-flex">
                    <div style="flex:1" class="border-right text-center">
                        <i class="{{$service->icon_class}}" style="font-size: 80px"></i>
                    </div>

                    <div style="flex:9">
                        <div class="card-header">
                            <div class="d-flex">
                                <h2 style="flex:1"><strong>"{{$service->title}}"</strong></h2>
                                {{-- Delete Button --}}
                                <form action="/admin/services/{{$service->id}}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn bn-default text-danger">X</button>    
                                </form>
                            </div>
                        </div>
                        
                        <div class="card-body">
                            <p>{{$service->description}}</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    @empty
        No services yet.
    @endforelse
@endsection