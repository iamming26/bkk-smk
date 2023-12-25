<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
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
                    <ul class="navbar-nav me-auto">

                    </ul>

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
                                    <a href="#" class="dropdown-item">
                                        Profil
                                    </a>
                                    <a href="#" class="dropdown-item">
                                        Riwayat Lamaran
                                    </a>
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
                <div class="row mt-4 justify-content-center">

                    @foreach ($jobs as $job)
                    <div class="col-md-4">
                        <div class="card" style="width: 18rem;">
                            <img src="https://dummyimage.com/600x400/000/fff" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">PT ASTRA HONDA MOTOR</h5>
                                <p class="card-text">Posisi: Operator Produksi</p>
                            </div>
                            <div class="card-body">
                                @if (Route::has('login'))
                                <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                                        <a href="#" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#detailModal{{ $loop->iteration }}">Detail</a>
                                        @auth
                                        <a href="#" class="btn btn-sm btn-primary">Lamar</a>
                                        @else
                                        <a href="{{ route('login') }}" class="btn btn-sm btn-primary">Login</a>
                                        @endauth
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="detailModal{{ $loop->iteration }}" tabindex="-1" aria-labelledby="detailModal{{}}Label" aria-hidden="true">
                        <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="detailModal{{ $loop->iteration }}Label">Detail</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                            ...
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                                @auth
                                <a href="#" class="btn btn-sm btn-primary">Lamar</a>
                                @else
                                <a href="{{ route('login') }}" class="btn btn-sm btn-primary">Login</a>
                                @endauth
                            </div>
                        </div>
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
            
            @yield('content')
        </main>
    </div>
</body>
</html>

