@extends('layouts.admin')

@section('content')
    @include('flashMessage')
    <a href="/admin/projects/create" class="btn btn-default border-primary m-3">Create project</a>
    @forelse ($projects as $project)
        <div class="border border-dark rounded m-3">
            <a href="/admin/projects/{{$project->id}}" class="text-dark text-decoration-none">
                <div class="d-flex">
                    <div style="flex:1; overflow:hidden; max-height: 150px; background-image : url('/storage/uploads/{{$project->image_name}}'); background-size: cover" class="border-right text-center">
                    </div>
                    <div style="flex:1" class="border-right text-center">
                        <i class="{{$project->icon_class}}" style="font-size: 80px"></i>
                    </div>

                    <div style="flex:8">
                        <div class="card-header">
                            <div class="d-flex">
                                <h2 style="flex:1"><strong>"{{$project->title}}"</strong></h2>
                                {{-- Delete Button --}}
                                <form action="/admin/projects/{{$project->id}}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn bn-default text-danger">X</button>    
                                </form>
                            </div>
                        </div>
                        
                        <div class="card-body">
                            <p>{{$project->excerpt()}}</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    @empty
        No projects yet.
    @endforelse
@endsection