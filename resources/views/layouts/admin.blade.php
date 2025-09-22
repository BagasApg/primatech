<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>CureMart</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    {{-- Feathericon --}}
    <script src="{{ asset('assets/js/feather.js') }}"></script>

    {{-- JQ --}}
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>


    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<style>
    .sidebar {
        background-color: #0f6448 !important;
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

    .nav-link.active {
        background-color: #19954b !important;
    }

    .nav-item:hover {
        background-color: #024a37;
    }
</style>

<body>

    <main class="d-flex flex-nowrap">

        <div class="sidebar d-flex flex-column flex-shrink-0 p-3 text-bg-dark vh-100 position-fixed top-0 bottom-0 start-0"
            style="width: 280px">
            <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                <span class="fs-4 ps-3">CureMart</span>
            </a>
            <hr />
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item">
                    <a href="{{ route('admin.user.index') }}"
                        class="nav-link ps-3

                    @if (Request::is('admin/user*')) active
                    @else
                    text-white @endif

                    "
                        aria-current="page">
                        Users
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.category.index') }}"
                        class="nav-link ps-3

                    @if (Request::is('admin/categories*')) active
                    @else
                    text-white @endif

                    "
                        aria-current="page">
                        Categories
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.product.index') }}"
                        class="nav-link ps-3

                    @if (Request::is('admin/product*')) active
                    @else
                    text-white @endif
                    "
                        aria-current="page">
                        Products
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.orders') }}"
                        class="nav-link ps-3

                    @if (Request::is('admin/orders*')) active
                    @else
                    text-white @endif
                    "
                        aria-current="page">
                        Orders
                    </a>
                </li>
            </ul>
            <hr />
            <div class="dropdown">
                <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="https://github.com/mdo.png" alt="" width="32" height="32"
                        class="rounded-circle me-2" />
                    <strong>
                        {{ Auth::user()->name }}
                    </strong>
                </a>
                <div class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
        </div>

        <div class="pt-4 pb-5" style="padding-left: 19rem; width:100vw">
            <div class="row g-0">
                @yield('content')
            </div>
        </div>

    </main>

    <script>
        function previewImage() {
            const image = document.querySelector('#image');
            const imgPreview = document.querySelector('.img-preview');

            imgPreview.style.display = 'block';

            const OFReader = new FileReader();
            OFReader.readAsDataURL(image.files[0]);

            OFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }

        feather.replace();
    </script>

</body>

</html>
