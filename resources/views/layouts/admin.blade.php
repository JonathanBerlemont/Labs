<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="{{ asset('js/jquery-2.1.4.min.js')}}" defer></script>
        <script src="{{ asset('js/bootstrap.min.js')}}" defer></script>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
        <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}" />
        <link rel="stylesheet" href="{{asset('css/flaticon.css')}}" />

        <link rel="icon" href="/img/logo.png">
    </head>

    <body>
        <div class="row m-0 p-0">
            {{-- Admin Panel--}}
            <div class="col-2 bg-secondary d-flex flex-column" style="height:100vh; position:fixed">

                {{-- Logo --}}
                <div class="mx-auto mt-2">
                    <img src="/img/logo.png" alt="">
                </div>

                {{-- To Website --}}
                <a class="btn btn-light d-block m-3" href="/">View Website</a>
                <hr class="bg-dark w-75">

                {{-- Dashboard --}}
                <a class="btn btn-success d-block m-3 {{Request::is('*admin') ? 'active' : null}}" href="/admin">Dashboard</a>
                
                {{-- Controls --}}
                <a class="btn btn-light d-block m-3 {{Request::is('*admin/blog*') ? 'active' : null}}" href="/admin/blog">Blogs</a>
                <a class="btn btn-light d-block m-3 {{Request::is('*admin/projects*') ? 'active' : null}}" href="/admin/projects">Projects</a>
                <a class="btn btn-light d-block m-3 {{Request::is('*admin/services*') ? 'active' : null}}" href="/admin/services">Services</a>
                <a class="btn btn-light d-block m-3 {{Request::is('*admin/testimonials*') ? 'active' : null}}" href="/admin/testimonials">Testimonials</a>
                <a class="btn btn-light d-block m-3 {{Request::is('*admin/team*') ? 'active' : null}}" href="/admin/team">Team</a>
                <hr class="bg-dark w-75">
                <div class="d-flex btn btn-primary m-3 {{Request::is('*admin/contact*') ? 'active' : null}} {{Request::is('*admin/mails*') ? 'active' : null}}">
                    <a class="text-light text-decoration-none " href="/admin/contact" style="flex:1; ">Contact / Mails</a> 
                    @if ((count(App\Mail::where('read', 0)->get())) != 0)
                        <div class="bg-danger rounded-circle " style="height: 20px; width: 20px; position:absolute; margin-left: 65%">
                            {{count(App\Mail::where('read', 0)->get())}}
                        </div>
                    @endif
                </div>
                <a class="btn btn-primary d-block m-3 {{Request::is('*admin/newsletter*') ? 'active' : null}}" href="/admin/newsletter">Newsletter</a>
                <a class="btn btn-primary d-block m-3 {{Request::is('*admin/users*') ? 'active' : null}}" href="/admin/users">Manage Users</a>

                {{-- Logout button--}}
                <a class="btn btn-danger d-block m-3 mt-auto" href="/logout">Logout</a>
            </div>
            
            {{-- Content --}}
            <div class="offset-2 col-10">
                @yield('content')
            </div>
        </div>

        <style>
            .active {
                border: solid yellow !important;
            }
        </style>
    </body>
</html>