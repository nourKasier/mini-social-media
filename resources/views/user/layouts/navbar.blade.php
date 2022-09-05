<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    <script src="{{ asset('js/bootstrap.min.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/home-page/style.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/fontawesome-free-5.15.3-web/css/all.css') }}" rel="stylesheet">

    {{-- <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script> --}}
    {{-- <script src="https://ajax.aspnetcdn.com/ajax/jquery/jquery-1.9.0.js"></script> --}}

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" ></script>
</head>
<body>
    <div id="app">
        {{-- <!-- Navbar-->
        <nav class="navbar navbar-expand-md navbar-dark bg-dark" >
            <div class="container-fluid justify-content-between" style="background:#3B5998;">
                <!-- Left elements -->
                <div class="d-flex">
                    <!-- Brand -->
                    <a class="navbar-brand me-2 mb-1 d-flex align-items-center" href="#">
                    <img
                    src="https://mdbcdn.b-cdn.net/img/logo/mdb-transaprent-noshadows.webp"
                    height="20"
                    alt="MDB Logo"
                    loading="lazy"
                    style="margin-top: 2px;"
                    />
                    </a>

                    <!-- Search form -->
                    <ul class="navbar-nav flex-row d-none d-md-flex">
                    <form class="input-group w-auto my-auto d-none d-sm-flex">
                        <input
                        autocomplete="off"
                        type="search"
                        class="form-control rounded"
                        placeholder="Search"
                        style="min-width: 125px;"
                        />
                        <span class="input-group-text border-0 d-none d-lg-flex">
                        <i class="fas fa-search"></i>
                        </span>
                    </form>
                    </ul>
                    <!-- Profile icon -->
                    <ul class="navbar-nav flex-row">
                    <li class="nav-item me-3 me-lg-1">
                        <a class="nav-link d-sm-flex align-items-sm-center" href="#">
                        <img
                            src="https://mdbcdn.b-cdn.net/img/new/avatars/1.webp"
                            class="rounded-circle"
                            height="22"
                            alt="Black and White Portrait of a Man"
                            loading="lazy"
                        />
                        <strong class="d-none d-sm-block ms-1">John</strong>
                        </a>
                    </li>
                    </ul>
                </div>
                <!-- Left elements -->
            </div>
        </nav> --}}

        <!-- Navbar -->
        <nav class="navbar navbar-expand-md navbar-dark" style="background-color: #3B5998;">
            <ul class="col col-xs-4 navbar-nav">
            <a href="#" class="col-xs-4 navbar-brand col mx-auto" style="color:white;">Logo</a>
            </ul>
            {{-- <form class="form-inline fluid-width col-10 mx-auto " >
                <input type="text" class="col-xs-6 form-control fluid-width col-12 mx-auto" style="background: #3B5998; color:white;" placeholder="Search">
            </form> --}}
            <ul class="col col-xs-4 navbar-nav">
                <li class="nav-item" >
                    <a class="nav-link" href="#">
                        <span><i class="fas fa-user fa-lg " style="color:white;"></i></span>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- Navbar -->

        <!-- Navbar Line 2 -->
        <nav class="navbar navbar-expand-md navbar-dark" style="background-color: #FFFFFF;">
            <ul class="col col-xs-4 navbar-nav mx-auto">
                <li class="nav-item mx-auto">
                    <a class="nav-link" href="/posts" style="">
                        <span><i class="fas fa-home fa-lg home-icon"></i></span>
                    </a>
                </li>
            </ul>
            <ul class="col col-xs-4 navbar-nav mx-auto">
                <li class="nav-item mx-auto">
                    <a class="nav-link" href="/createPostPage">
                        <span><i class="fas fa-edit fa-lg home-icon"></i></span>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- Navbar Line 2 -->
        <!-- Line -->
        <hr style="margin-top: 0rem;
        margin-bottom: 0rem;
        border: 0;
        border-top: 5px solid #e1dada;"/>
        <!-- Line -->

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>

</html>
