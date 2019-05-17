@extends('layouts.admin')

@section('content')
    @include('flashMessage')
    <div class="card m-5 w-25">
        <div class="card-header">
            <h3>People Subscribed</h3>
        </div>
        <div class="card-body p-3">
            @foreach ($emails as $email)
                <div class="border p-1 d-flex align-items-center">
                    <p class="my-2" style="flex:1">{{$email->email}}</p>
                    {{-- Delete Button --}}
                    <form action="/admin/newsletter/{{$email->id}}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn bn-default text-danger">X</button>    
                    </form>
                </div>
            @endforeach
        </div>
    </div>

    <a href="/admin/newsletter/send" class="btn btn-primary ml-5">Send a Newsletter</a>
@endsection