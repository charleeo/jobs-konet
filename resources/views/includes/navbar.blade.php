<div id="slideout-menu">
    <ul>
      <li><a href="/">Home</a></li>
      <li><a href="{{route('about')}}">About</a></li>
      @if(Auth::user())
    <li><a href="/profile">Dashbaord</a></li>
      <li>
         <a href="{{ route('logout') }}"
          onclick="event.preventDefault();
        document.getElementById('logout-form').submit();" class="text-danger">
            {{ __('Logout') }} <i class="fas fa-sign-out-alt"></i>
        </a>
        {{-- <a href="{{ route('home')}}" class="dropdown-item">Profile</a> --}}

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </li>
      @else
      <li>
          <a href="/login">Login</a>
      </li>
        <li>
        <a href="/register">Register</a>
        </li>
      <li></li>
      @endif
      <li>
        <input type="text" placeholder="search here"/>
      </li>
    </ul>
    <div id="control-side-menu">
        <b class="text-light">sidebar</b><i class="fas fa-arrow-left fa-2x text-white"></i>
    </div>
  </div>

  <nav>
    <div id="logo-img">
      <a href="/">
        {{config('app.name','Jobs Hub Connect')}}
      </a>
    </div>
    <div id="menu-icon">
      <i class="fas fa-bars"></i>
    </div>
    {{-- <div class="menu-btn">
        <span class="menu-btn_burger"></span>
    </div> --}}
    <ul>
      <li><a href="/" class="">Home</a></li>
      <li><a href="{{route('about')}}">About</a></li>
      @if(Auth::user())
    <li><a href="/profile">Dashbaord</a></li>
      <li>
          <a href="{{ route('logout') }}"
          onclick="event.preventDefault();
        document.getElementById('logout-form').submit();" class="text-danger">
            {{ __('Logout') }} <i class="fas fa-sign-out-alt"></i>
        </a>
        {{-- <a href="{{ route('home')}}" class="dropdown-item">Profile</a> --}}

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </li>
      @else
      <li>
          <a href="/login">Login</a>
      </li>
        <li>
        <a href="/register">Register</a>
        </li>
      <li></li>
      @endif

      {{-- <li>
        <div id="search-icon"><i class="fas fa-search"></i></div>
      </li> --}}
    </ul>
  </nav>
  <div id="searchbox">
    <input type="text" placeholder="search here">
  </div>
