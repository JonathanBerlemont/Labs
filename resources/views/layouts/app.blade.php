<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" style="scroll-behavior: smooth">
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
    <script src="{{ asset('js/magnific-popup.min.js')}}" defer></script>
    <script src="{{ asset('js/owl.carousel.min.js')}}" defer></script>
    <script src="{{ asset('js/circle-progress.min.js')}}" defer></script>
    <script src="{{ asset('js/main.js')}}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @if (! Route::is('login') && ! Route::is('verify') && ! Route::is('home'))
        <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}" />
    @endif
    <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}" />
    <link rel="stylesheet" href="{{asset('css/flaticon.css')}}" />
    <link rel="stylesheet" href="{{asset('css/magnific-popup.css')}}" />
    <link rel="stylesheet" href="{{asset('css/owl.carousel.css')}}" />
    <link rel="stylesheet" href="{{asset('css/style.css')}}" />

    <link rel="icon" href="/img/logo.png">
</head>

<body>
    <div id="app">
        <!-- Header section -->
        @if (! Route::is('login') && ! Route::is('verify') && ! Route::is('home'))
        <header class="header-section">
            <div class="logo">
                <img src="/img/logo.png" alt=""><!-- Logo -->
            </div>
            <!-- Navigation -->
            <div class="responsive"><i class="fa fa-bars"></i></div>
            <nav>
                <ul class="menu-list">
                    <li class="{{Request::is('*/') ? 'active' : null}}"><a href="/">Home</a></li>
                    <li class="{{Request::is('*services*') ? 'active' : null}}"><a href="/services">Services</a></li>
                    <li class="{{Request::is('*blog*') ? 'active' : null}}"><a href="/blog">Blog</a></li>
                    <li class="{{Request::is('*contact*') ? 'active' : null}}"><a href="/contact">Contact</a></li>
                    @auth
                    <li><a href="/admin" class="bg-primary text-light">Admin</a></li>
                    @endauth
                </ul>
            </nav>
        </header>
        <!-- Header section end -->

        <!-- FIN HEADER
        ============================================ -->
        @endif

        <!-- Page Preloder -->
        <div id="preloder">
            <div class="loader">
                <img src="/img/logo.png" alt="">
                <h2>Loading.....</h2>
            </div>
        </div>

        <main style="margin-top: 91px">
            @yield('content')
        </main>
    </div>
</body>
</html>
