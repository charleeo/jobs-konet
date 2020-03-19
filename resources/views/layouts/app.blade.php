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

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">
</head>
<body>
    @if(!Request::is(['/','admin/login', 'login', 'register', 'password/reset', 'home']))
        @include('includes.sidebar')
    @endif
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->

    <div id="page-content-wrapper">

            <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
                    <div class="container">
                        <a class="navbar-brand" href="{{ url('/') }}">
                            {{ config('app.name', 'MultiAuth') }}
                        </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <!-- Left Side Of Navbar -->
                            <ul class="navbar-nav mr-auto">

                            </ul>

                            <!-- Right Side Of Navbar -->
                            <ul class="navbar-nav ml-auto">
                                <!-- Authentication Links -->
                                @guest
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                    </li>
                                    @if (Route::has('register'))
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                        </li>
                                    @endif
                                @else
                                    <li class="nav-item dropdown">
                                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                            {{ Auth::user()->name }} <span class="caret"></span>
                                        </a>

                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                            <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                             document.getElementById('logout-form').submit();">
                                                {{ __('Logout') }}
                                            </a>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                    @csrf
                                                </form>
                                        </div>
                                    </li>

                                    @can('user_type', Auth::user())

                                    @php
                                        $firstName = explode(' ', Auth::user()->name);

                                    @endphp

                                        <li class="nav-item" >
                                            <a href="{{ route('dashboard', ['type'=> Auth::user()->users_type, 'name'=>$firstName[0]])}}" class="nav-link text-secondary">Your DashBoard</a>
                                        </li>
                                    @endcan
                                    @endguest
                            </ul>
                        </div>
                    </div>
                </nav>
            @if(!Request::is(['/','admin/login', 'login', 'register', 'password/reset', 'home']))

            <small id="side-bar-toggler">
                    <button class="btn btn-sm btn-info text-light" id="menu-toggle">open side menu</button>
            </small>
            @endif

      <div class="container-fluid">
            <main class="py-2">
                @yield('content')
            </main>
      </div>
    </div>
    <!-- /#page-content-wrapper -->

  </div>


  <!-- Bootstrap core JavaScript -->
  <script src="{{ asset('js/jquery.js')}}"></script>
  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}" defer></script>


  <!-- Menu Toggle Script -->
  <script>
      let menu = document.querySelector("#menu-toggle")
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      if(menu.textContent== 'open side menu'){
        menu.textContent = 'close side menu';
      }
      else{ menu.textContent = 'open side menu'}
      $("#wrapper").toggleClass("toggled");

    });
  </script>

</body>

</html>

