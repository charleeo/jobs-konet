<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- <title>{{ config('app.name', 'Laravel') }}</title> --}}

        <title>{{ config('app.name', 'FINGER TIP KONNECT') }}:{{$title}} </title>
    <!-- Fonts -->
    <link rel="icon" href="{{asset('images/icon/favicon.png')}}" type="image/gif">
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300&display=swap" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">


    <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">
    <link href="{{ asset('css/customcss.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main/app.css') }}" rel="stylesheet">
</head>
<body>

 <main>
    <div>
        @include('includes.navbar')
        <section id="dasboard-divider">
        @if(Auth::user() AND !Request::is('/') AND !Request::is('pages/about'))
                @include('includes.sidebar')
            @endif
            <div id="main-content">
                @include('includes.messages')
                @yield('content')
            </div>
        </section>
        @include('includes.footer')
    </div>
</main>


  <!-- Bootstrap core JavaScript -->
  <script src="{{ asset('js/jquery.js')}}"></script>
  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}" defer></script>
  <script src="{{ asset('js/custom.js') }}"></script>
  <script src="https://kit.fontawesome.com/b4ec2ce099.js"></script>
  <script src="https://cdn.ckeditor.com/ckeditor5/24.0.0/classic/ckeditor.js"></script>
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script src="{{asset('js/main.js')}}"></script>

</body>

</html>

