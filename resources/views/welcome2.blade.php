@extends('layouts.app')

@section('content')
<main>
    <section class="home">
        <header>
            <div class="row d-flex">
                <div class="col-md-12">
                    <div class="heart"></div>
                    <h1 class="home_name" data-aos="fade-right">
                        <small class="text text-dark">Welcome To</small>
                        <span class="home_name--last"> {{ config('app.name', 'MultiAuth') }}</span>
                    </h1>
                    <h4 class=" text-dark  py-4" data-aos="fade-up">Get Connetd To TOP GIGs Fast</h4>
                </div>
            </div>
            @if(!Auth::check())
            <a href="/login">
                <span class="button"  data-aos="fade-down">Get Stated Today</span>
            </a>
            @else
             <span class="button ">See How It Works</span>
            @endif
            <span class="logo "> </span>
            <span class="logo-top-right"> </span>
        </header>
    </section>
</main>

<section class="who-we-are p-5 mt-5">
    <div class="row justify-content-center">
        <h1 class="text-center we">WHO WE ARE</h1>
        <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
              <div class="carousel-item active">
                <h1>Test us today and you be glad you did</h1>
              </div>
              <div class="carousel-item">
                <h1>We are top notch world class ict solution in nigeria</h1>
              </div>
              <div class="carousel-item">
                  <h1>We Are Leading Giant In Information Management and Transactions </h1>
              </div>
            </div>
        </div>
    </div>
</section>

<section id="about-us">
    <div class="row justify-content-center">
        <div class="col-md-4" data-aos="fade-right">
            <div>OUR</div>
            <div>MISSION</div>
        </div>
        <div class="col-md-5" data-aos="fade-left">
            <span class="type-text"></span> <span class="cursor">&nbsp;</span>
        </div>
    </div>
</section >
        <section  class="pl-4 employees  p-5" id="employee">
            <div class="row d-flex justify-content-center border-0 ">
                <div class="col-md ">
                    <h4 class="text-center">
                        <a href="{{route('applicant.all')}}" class=" pl-2 pr-2"> Visit "APPLICANTS" Corner For More</a>
                    </h4>
                </div>
            </div> <br>

            <div class="row  d-flex flex-wramp  justify-content-center ">
             @foreach ($applicantsHomeView as $applicant)
             <div class="col-md-5 mb-3  ml-2" >
                <div class="align-self-center">
                    <div class="row " data-aos="fade-right">
                        {{-- Image and Title --}}
                        <div class="col-sm-5  shadow py-2 pb-3">
                            <h6 class=" justify-content-center">
                                @php
                                $path = asset('images/profile_pics/default-image');

                                if ($applicant->user->profile_photo !== 'noimage.png'){
                                    $path = asset('images/profile_pics');
                                }
                                @endphp
                                <img src="{{$path .'/'.$applicant->user->profile_photo}}" alt="profile image" class="rounded-circle" width="100" height="100">
                            </h6>
                            <hr>
                            <h6>{{$applicant->first_name}}
                               {{$applicant->other_names}}
                            </h6>
                            <h6>
                                Professional Title: {{$applicant->designation}}
                            </h6>
                            <button class="btn btn-link" >
                            <a href="{{route('applicant.details', [$applicant->applicant_id])}}" ><i class="far fa-eye text-danger"></i> Detail
                            </a>
                            </button>
                        </div>
                        {{-- Skills --}}
                        <div class="col-sm-7 shadow py-2 pb-3" data-aos="fade-left">
                            <div class="row">
                                <div class="col ">
                                    <h6 class="text-center">Skills:</h6> <hr/>
                                    <ol class="d-flex flex-wrap pl-4" id="skills">
                                        @foreach (explode(',', $applicant->skills) as $skill)
                                            <li class="ml-3">{{strtolower($skill)}}</li> &nbsp;&nbsp;
                                        @endforeach
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                @endforeach
            </div>
        </section>

        <section class="mt-5 shadow-lg">
            <div class="row d-flex justify-content-center p-4">
                {{-- <div class="col-sm-4">
                    <h5>Available Jobs</h5>
                </div> --}}
                <div class="col-sm-8 offset-md-2">
                    <div class=" ">
                        <a href="{{route('all-vacancies')}}" class="btn btn-dark text-light">VACANCIES CORNER FOR MORE</a>
                    </div>
                </div>
            </div>
            <div class="row  d-flex flex-wramp justify-content-center">
            @foreach ($vacancies as $vacancy)
            @php
                $explodedTitle = explode(' ', $vacancy->role_title) ;
                $implodedTitle = implode('-', $explodedTitle)
                @endphp
            <a href="{{ route ('vacancy.details', [$vacancy->employer_id, $vacancy->category_id, $implodedTitle ]) }}" class="text-dark">
            <div class="col-md-3 mb-3 shadow-lg ">
                <div class="card deccided-height border-0 ">
                    <div class="card-body  ">
                            {{ $vacancy->role_title }}
                                <small>
                                    <p>
                                        {!! html_entity_decode(substr($vacancy->summary,  0, 100))!!}
                                    </p>
                                </small>
                                <address> Location: {{$vacancy->state->state_name}} State</address>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </section>

        <section  class="shadow-lg  mt-5" id="others" >
            <div class="mapouter">
                <div class="gmap_canvas"><iframe width="100%" height="100%" id="gmap_canvas" src="https://maps.google.com/maps?q= allen&t=k&z=11&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://123movies-to.org"></a><br><style>.mapouter{position:relative;text-align:center;height:100%;width:100%;}</style><a href="https://www.embedgooglemap.net">Jobs Hub Direction</a><style>.gmap_canvas {overflow:hidden;background:none!important;height:100%;width:100%;}</style></div>
            </div>
        </section>
    @endsection
