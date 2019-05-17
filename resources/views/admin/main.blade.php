@extends('layouts.admin')

@section('content')
    <h1 class="text-center my-5">Dernières activités de la team</h1>
    <div class="row m-0 p-0">
        @foreach (App\User::all() as $user)
            <div class="col-4">
                <div class="card mb-4">
                    <div class="card-header">
                        <div class="d-flex">
                            <h4 style="flex:1">{{$user->name}}</h4>
                            <p class="
                                {{($user->role == 'admin') ? 'text-danger': null }} 
                                {{($user->role == 'writer') ? 'text-primary' : null }}
                                ">
                                {{ucfirst($user->role)}}
                            </p>
                        </div>
                    </div>
                    <div class="card-body" style="max-height:250px; overflow-y:scroll ">
                        @forelse (App\Activity::where('user_id', $user->id)->latest()->get() as $activity)

                            @include('admin.activity')
                            
                            <hr class="w-50 ml-0 mr-auto">
                        @empty
                            No activity yet
                        @endforelse
                    </div>
                </div>
            </div>
        @endforeach
    </div>
  
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