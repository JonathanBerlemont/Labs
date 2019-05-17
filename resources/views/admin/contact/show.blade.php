@extends('layouts.admin')

@section('content')
    <div class="d-flex m-5">
        <a href="/admin/contact" class="btn btn-dark mr-3">Back</a>
        {{-- Delete button --}}
        <form action="/admin/mails/{{$mail->id}}" method="post">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-danger">Delete Email</button>
        </form>
    </div>

    <div class="card m-5 w-75">
        <div class="card-header">
            <h3><strong>Subject: </strong>{{$mail->subject}}</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-2 border-right">
                    <p><strong>From:</strong><br> {{$mail->name}}</p>
                    <p><strong>Email:</strong><br>  {{$mail->email}}</p>
                </div>
                <div class="col-10">
                    <p><strong>Message:</strong><br>{{$mail->message}}</p>
                </div>
            </div>
        </div>
    </div>
@endsection