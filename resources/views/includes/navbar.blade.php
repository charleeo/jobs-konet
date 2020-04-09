<nav class="navbar navbar-expand-md navbar-light  nav-class  pb-3  shadow-lg ">
<a class="navbar-brand text-light" href="{{ url('/') }}">
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
                    <a class="nav-link text-light" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link text-light" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif
            @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }} <span class="caret"></span>
                        <span class="img-circle">
                        <img src="{{asset($profilePhoto)}}" alt="{{Auth::user()->profile_photo}}" width="15px" height="15" class="img-circle" >
                        </span>
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
                @if(Auth::user())

                <small id="side-bar-toggler">
                        <button class="btn btn-sm btn-info text-light" id="menu-toggle">open side menu</button>
                </small>
                @endif
            </div>
        </nav>
