<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>HealthGo</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    {{-- JQ --}}
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>

    {{-- MIDTRANS SNAP --}}
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}">
    </script>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<style>
    .navbar {
        background-color: #10B981 !important;
    }

    .navbar a {
        color: white !important;
    }

    footer {
        background-color: #10B981 !important;
    }

    body {
        background-color: #f9fafb;
    }

    .card {
        border: 2px solid #d1fae5;
    }

    .card-title {
        color: #065f46;
    }

    .btn-primary {
        background-color: #10b981 !important;
        border-color: #10b981 !important;
    }

    .btn-primary:hover {
        background-color: #047857 !important;
        border-color: #047857 !important;
    }
</style>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container-fluid" style="padding: 0 8rem">
                <a class="navbar-brand fw-bold" href="{{ url('/') }}">
                    CureMart
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('product.index') }}">Products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('order.index') }}">Order</a>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a href="{{ route('cart.index') }}" class="nav-link">Cart</a>
                        </li>
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
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item text-black" href="{{ route('logout') }}"
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
            @yield('content')
        </main>

        <div class="b-example-divider"></div>

        {{-- FEEDBACK --}}
        {{-- <footer class="py-4 mt-3 border-top">
            <div class="container">
                <p class="fs-4 fw-bold text-white">Biar kami makin oke, tulis pesan/saran di bawah!</p>
                <input class="form-control mb-3" type="text" placeholder="John Doe"
                    aria-label="default input example">
                <textarea class="form-control mb-3" id="exampleFormControlTextarea1" rows="3"
                    placeholder="Produknya beragam, respon cepet banget!"></textarea>
                <button class="btn btn-success d-inline-block">Kirim!</button>
            </div>
        </footer> --}}
        {{-- FEEDBACK --}}

        {{-- COMMENT --}}
        <footer class="py-4 mt-3 border-top">
            <div class="container">
                <div class="form-area">
                    <form action="{{ route('guestbook.store') }}" method="post">
                        @csrf
                        <p class="fs-4 fw-bold text-white">Biar kami makin oke, tulis pesan/saran di bawah!</p>
                        <input class="form-control mb-3" type="text" placeholder="John Doe"
                            aria-label="default input example" name="sender">
                        <textarea class="form-control mb-3" id="exampleFormControlTextarea1" rows="3"
                            placeholder="Produknya beragam, respon cepet banget!" name="message"></textarea>
                        <button class="btn btn-success d-inline-block">Kirim!</button>
                    </form>
                </div>

            </div>
        </footer>
        {{-- COMMENT --}}

    </div>
</body>

</html>
