<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{(( $title  .' - ') ?? '') . config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    @auth
                        <ul class="navbar-nav me-auto">
                            <li @class(['nav-item', 'fw-bold text-primary' =>  $nav == 'links'])"><a href="{{ route('links.index') }}" class="nav-link">URLs</a></li>
                            <li @class(['nav-item', 'fw-bold text-primary' =>  $nav == 'profile'])"><a href="{{ route('users.edit', auth()->user()) }}" class="nav-link">Profile</a></li>
                        </ul>
                    @endauth
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">

            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header text-center">

                                @yield('content-header')

                            </div>

                            <div class="card-body py-2">

                                @if (session('success'))
                                <div class="alert alert-success text-center" role="alert">
                                   <strong>Success! </strong> {!! session('success') !!}
                                </div>
                                @endif

                                @if (session('fail'))
                                <div class="alert alert-danger text-center" role="alert">
                                   <strong>Error! </strong> {{ session('fail') }}
                                </div>
                                @endif

                                @yield('content-body')

                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </main>

        <footer class="footer">
            <div class="container d-flex align-items-center justify-content-center mt-5 py-5 text-center" style="background-color: #f7f7f7 ">
              <span class="text-muted">&copy; {{ date('Y') }}. All Rights Reserved. Designed By  <a href="https://github.com/nickyraph" target="_blank" style="text-decoration: none">Nicky</a> <br>
                <a href="mailto:raphpeterolomi@gmail.com" style="text-decoration: none">raphpeterolomi@gmail.com</a> <br>
                <a href="tel:+255786065529" style="text-decoration: none">0786065529</a>
            </span>
            </div>
          </footer>
    </div>
</body>
</html>
