@extends('layouts.admin')

@section('content')
@include('flashMessage')
    <div class="d-flex">
        <div class="card m-5 w-25" style="max-height:500px">
            <div class="card-header">
                <h3>Mails flagged as Testimonials</h3>
                <em style="font-size: 12px">(If you validate a testimonial, it will be created with a job "Unknown")</em>
            </div>
            <div class="card-body p-3" style="overflow-y: scroll">
                @foreach ($mails as $mail)
                    <div class="border p-1 d-flex align-items-center">
                        <p class="my-2 px-2" style="flex:1"><em style="font-size:12px">({{$mail->name}})</em><br>{{$mail->message}}</p>
                        <div>
                            {{-- Flag Button --}}
                            <form action="/admin/testimonials" method="post">
                                @csrf
                                <input type="text" name="message" hidden value="{{$mail->message}}">
                                <input type="text" name="id" hidden value="{{$mail->id}}">
                                <input type="text" name="name" hidden value="{{$mail->name}}">
                                <button type="submit" class="btn bn-default text-success">✓</button>    
                            </form>
                            {{-- Delete Button --}}
                            <form action="/admin/mails/{{$mail->id}}" method="post">
                                @csrf
                                @method('delete')
                                <input type="text" hidden name="testimonials" value="testimonials">
                                <button type="submit" class="btn bn-default text-danger">X</button>    
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    
        <div class="card m-5 w-50">
            <div class="card-header">
                <h2>Create Testimonial manualy</h2>
            </div>
            <div class="card-body">
                <form action="/admin/testimonials" method="post">
                    @csrf
                    <input type="text" name="name" class="form-control" placeholder="Name">
                    <input type="text" name="job" class="form-control my-2" placeholder="Job">
                    <textarea name="message" id="" cols="30" rows="10" class="form-control" placeholder="Text" required></textarea>

                    <button type="submit" class="btn btn-primary mt-4">Create</button>
                </form>
            </div>
        </div>
    </div>

    <div class="card mx-5 w-75">
        <div class="card-header">
            <h3>All Testimonials</h3>
        </div>
        <div class="card-body" style="overflow-y: scroll; height: 200px">
            @forelse (App\Testimonial::all() as $testimonial)
                <div class="border-bottom d-flex w-100">
                    {{\Illuminate\Support\Str::words($testimonial->message, $words = 15, $end='...')}}
                    <form action="/admin/testimonials/{{$testimonial->id}}" method="post" class="ml-auto">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-default text-danger p-0">X</button>
                    </form>
                </div>
            @empty
                No testimonials yet
            @endforelse
        </div>
    </div>
@endsection