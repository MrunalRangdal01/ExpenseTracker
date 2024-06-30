<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/sidebar_style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">


    <style>
        body, html {
    font-family: 'Quicksand', sans-serif;
    font-size: 16px;
}

        .modal-content {
  background-color: #fefefe;
  margin: auto;
  padding: 20px;
  border: 1px solid #888;
  width: 80%;
}

/* The Close Button */
.close {
  color: #aaaaaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}

.required-field::after {
    content: " *";
    color: red;
}
    </style>
</head>
<body>
    <div id="app">
        <!-- Sidebar -->
        <input type="checkbox" id="check" checked>
        <!-- <label for="check"> -->
            <!-- <i class="fas fa-bars" id="btn"></i> -->
            <!-- <i class="fas fa-times" id="cancel"></i> -->
        <!-- </label> -->
        <div class="sidebar">
            <header>My Expense</header>
            <ul>
                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <li><a href="{{ route('login') }}">{{ __('Login') }}</a></li>
                    @endif

                    @if (Route::has('register'))
                        <li><a href="{{ route('register') }}">{{ __('Register') }}</a></li>
                    @endif
                @else
                    <!-- <li>
                        <a href="#">
                        <i class="fa fa-user"></i> {{ strtoupper(Auth::user()->name) }}
                        </a>
                    </li> -->
                                    <li><a href="{{route('home')}}"><i class="fas fa-qrcode"></i>Dashboard</a></li>
                <li><a href="{{route('category')}}"><i class="fas fa-list"></i>Category</a></li>
                <li><a href="{{route('expense')}}"><i class="fas fa-stream"></i>Expenses</a></li>

                    <li>
                        <a  href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                            <i class="fa fa-power-off"></i>{{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                @endguest
            </ul>
        </div>

        <!-- Main Content -->
        <section>
            <main class="py-4">
                @yield('content')
            </main>
        </section>
    </div>
</body>
</html>
