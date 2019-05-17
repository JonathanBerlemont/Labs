@extends('layouts.admin')

@section('content')
    @include('flashMessage')
    <a href="/admin/team/create" class="btn btn-primary mt-5 ml-5">Add a new member to the Team</a>
    <div class="card m-5 w-50">
        <div class="card-header d-flex">
            <h2 style="flex:1">Team members</h2>
            <em class="align-self-center" style="font-size: 12px">Mark the one to be put in the spotlight</em>
        </div>
        <div class="card-body p-3">
            <div>
                @forelse ($team as $member)
                    <div class="d-flex border-bottom align-items-center">
                        <div style="flex:1"><a href="/admin/team/{{$member->id}}">{{$member->name}}</a></div>
                        <div style="flex:1">{{$member->job}}</div>
                        <div style="flex:1">
                            <form action="/admin/team/{{$member->id}}" method="POST" class="text-right">
                                @csrf
                                @method('patch')
                                <input type="checkbox" name="flag" id="" onchange="this.form.submit()" {{($member->flag == 1) ? 'checked' : null}}>
                            </form>
                        </div>
                        <div>
                            <form action="/admin/team/{{$member->id}}" method="post" class="d-flex align-items-center">
                                @csrf
                                @method('delete')
                                <button type="submit" class="text-danger btn btn-default p-0 ml-3">X</button>
                            </form>
                        </div>
                    </div>
                @empty
                    No members yet
                @endforelse
            </div>
        </div>
    </div>
@endsection