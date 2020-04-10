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
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <!-- Styles -->
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
    <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">
    <link href="{{ asset('css/customcss.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>

    {{-- @if(!Request::is(['/','admin/login', 'login', 'vacancies/*', 'register', 'password/reset', 'home'])) --}}

    {{-- Include the side bar if some conditions are met --}}
    @if(Auth::user() && !Request::is(['/']))
        @include('includes.sidebar')
    @endif
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->


<div id="page-content-wrapper">

<div class="container-flui">
        @include('includes.navbar')
    </div>
            {{-- @if(!Request::is(['/','admin/login', 'login', 'register', 'password/reset', 'home'])) --}}

      <div class="container-flui">
            <main class="py-2">
                @include('includes.messages')
                @yield('content')
                @include('includes.footer')
            </main>
      </div>
    </div>
    <!-- /#page-content-wrapper -->

  </div>


  <!-- Bootstrap core JavaScript -->
  <script src="{{ asset('js/jquery.js')}}"></script>
  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}" defer></script>
  <script src="{{ asset('js/custom.js') }}"></script>
  <script src="https://kit.fontawesome.com/b4ec2ce099.js"></script>

  <!-- Menu Toggle Script -->
  <script>

  </script>

</body>

</html>

