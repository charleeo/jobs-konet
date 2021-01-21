@php
if(Auth::check()){

    $skills = checkForApplicantSkills(Auth::user()->id) ;
}
@endphp
<div class="sticky">

<nav class="navbar navbar-expand-md navbar-light  nav-class  pb-3 ">
<a class="navbar-brand text-light" href="{{ url('/') }}">
  
       <b class="app-name"> {{ config('app.name', 'Job Link') }}</b>
</a>

@if(Auth::user() && Auth::user()->users_type ==='applicant' && $skills['skills'] ==null)
<marquee behavior="scroll" direction="left" class="text-warning">
    NOTE: <b>
        For You to listed with other applicants on the applicants page as well as on the front-page, you should add skills to your profile. To do that, click on "Add Skills" Tab from the sidebar 
    </b>
</marquee>
@endif

<button class="navbar-toggler bg-light" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
<span class="navbar-toggler-icon"></span>
</button>

<div class="collapse navbar-collapse" id="navbarSupportedContent">

<ul class="navbar-nav ml-auto">
            <!-- Authentication Links -->
            @guest
                <li class="nav-item">
                    <a class="nav-link text-light" href="{{ route('login') }}">{{ __('Login') }}
                        <i class="fas fa-sign-in-alt text-info"></i>
                    </a>
                </li>
                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link text-light" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif
            @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle text-light " href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
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
                        <a href="{{ route('home')}}" class="dropdown-item">Profile</a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                    </div>
                </li>

                @can('user_type', Auth::user())

                @php
                    $firstName = explode(' ', Auth::user()->name);
                    @endphp
                @endcan
                @endguest
                </ul>
                @if(Auth::user())

                <small id="side-bar-toggler">
                        <button class="btn btn-sm btn-info text-light" id="menu-toggle"><i class="fa fa-bars fa-2x"></i></button>
                </small>
                @endif
            </div>
        </nav>
    </div>
