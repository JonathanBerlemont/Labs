@extends('layouts.admin')

@section('content')
    <div class="card-header">
        <h2>Mails and Contact</h2>
    </div>
    <div class="row m-0 p-0" style="height:100%">
        {{-- Filtering --}}
        <div class="col-2 p-0 pt-3 border-right border-dark">
            <a class="filter" id="all">All Messages <strong>({{count(App\Mail::all())}})</strong></a>
            <hr>
            <a class="filter" id="unread">Unread Messages <strong>({{count(App\Mail::where('read', 0)->get())}})</strong></a>
            <hr>
            <a class="filter" id="read">Read Messages <strong>({{count(App\Mail::where('read', 1)->get())}})</strong></a>
            <hr>
        </div>
        {{-- Messages --}}
        <div class="col-6 border-right border-dark" style="overflow-y: scroll">
            @forelse (App\Mail::latest()->get() as $mail)
                <div class="mail border-bottom d-flex {{($mail->read == 0) ? 'unread' : 'read'}}">
                    {{-- Name and notification --}}
                    <div style="flex:1">
                        <a href="/admin/mails/{{$mail->id}}" class="d-flex">
                            <div class="align-self-center pr-4" style="flex:1">
                                @if ($mail->read == 0)
                                    <div class="rounded-circle bg-danger mr-auto " style="width: 10px; height: 10px"></div>
                                @endif
                            </div>
                            <div style="flex:30">
                                <p class="align-self-center my-2">{{$mail->subject}} - from: {{$mail->name}}</p>
                            </div>
                        </a>
                    </div>
                    {{-- Delete button --}}
                    <form action="/admin/mails/{{$mail->id}}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn text-danger">Delete Email</button>
                    </form>
                </div>
            @empty
                No Mails
            @endforelse
        </div>
        {{-- Contact Info --}}
        <div class="col-4 p-0">
            <div class="card-header">
                <h4>Contact Information</h4>
            </div>
            
            <form action="/admin/contact" method="post" class="d-flex flex-column mt-3 p-3">
                @csrf
                <label for="description">Description</label>
                <textarea name="description" id="" cols="30" rows="10" placeholder="Description" class="form-control">{{env('CONTACT_DESCRIPTION')}}</textarea>
                <p>Main Office:</p>
                <input type="text" placeholder="Address"  name="address" value="{{env('CONTACT_ADDRESS')}}" class="form-control">
                <input type="text" placeholder="Phone Number"  name="phone" value="{{env('CONTACT_PHONE')}}" class="form-control">
                <input type="text" placeholder="Mail address"  name="email" value="{{env('CONTACT_MAIL')}}" class="form-control">

                <button type="submit" class="btn btn-primary mt-5">Update Info</button>
            </form>
            @if ($errors->any())
                <ul class="list-unstyled">
                    @foreach ($errors->all() as $error)
                        <li class="bg-warning text-danger">{{$error}}</li>
                    @endforeach
                </ul>
            @endif
        </div>
        @include('flashMessage')
    </div>

    <style>
        .mail:hover {
            cursor: pointer;
        }

        .filter:hover {
            cursor: pointer;
        }
    </style>

    <script>
        all = document.querySelector('#all');
        unread = document.querySelector('#unread');
        read = document.querySelector('#read');

        all_mails = document.querySelectorAll('.mail');
        unread_mails = document.querySelectorAll('.unread');
        read_mails = document.querySelectorAll('.read');

        all.addEventListener('click', () => {
            all_mails.forEach( (elem) => {
                console.log('All Mails');
                elem.classList.remove('d-none');
                elem.classList.add('d-flex');
            })
        })

        unread.addEventListener('click', () => {
            unread_mails.forEach( (elem) => {                
                console.log('Unread Mails');
                elem.classList.remove('d-none');
                elem.classList.add('d-flex');
            });
            read_mails.forEach( (elem) => { 
                elem.classList.add('d-none');
                elem.classList.remove('d-flex');
            });
        })

        read.addEventListener('click', () => {
            read_mails.forEach( (elem) => {
                console.log('Read Mails');
                elem.classList.remove('d-none');
                elem.classList.add('d-flex');
            });
            unread_mails.forEach( (elem) => {  
                elem.classList.add('d-none');
                elem.classList.remove('d-flex');
            });
        })

    </script>

@endsection