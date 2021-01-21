@extends('layouts.app')

@section('content')
<main>
    <section class="home">
        <header>
            <div class="row d-flex">
                <div class="col-md-12">
                    <div class="heart"></div>
                    <h1 class="home_name">
                        <small class="text text-dark">Welcome To</small>
                        <span class="home_name--last"> {{ config('app.name', 'MultiAuth') }}</span>
                    </h1>
                    <h4 class=" text-dark  py-4">Get Connetd To TOP GIGs Fast</h4>
                </div>
            </div>
            @if(!Auth::check())
            <a href="/login">
                <span class="button ">Get Stated Today</span>
            </a>
            @else
             <span class="button ">See How It Works</span>
            @endif
            <span class="logo "> </span>
            <span class="logo-top-right"> </span>
        </header>
    </section>
</main>
        <section class="pl-4 employees pt-4 " id="employee"
            data-aos="fade-up"
            data-aos-offset="200"
            data-aos-delay="10"
            data-aos-duration="100"
            data-aos-easing="ease-in-out"
            data-aos-mirror="true"
            data-aos-once="true"
            data-aos-anchor-placement="top-center"
        >
            <div class="row d-flex justify-content-center border-bottom"
            
            >
                <div class="col-md-3"><h4 class="text text-center">Potential Employees</h4></div>
                <div class="col-md-7">
                    <h4 class="text-center">
                        <a href="{{route('applicant.all')}}" class="btn btn-dark border pl-2 pr-2"> Visit Employees Corner For More</a>
                    </h4>
                </div>
            </div> <br>

            <div class="row  d-flex flex-wramp  justify-content-center">
                {{-- {{count($applicantsHomeView)}} --}}
            @foreach ($applicantsHomeView as $applicant)

            <div class="col-md-5 mb-3  ml-2" >
                <div class="align-self-center"
                >
                    <div class="row">
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
                        <div class="col-sm-7 shadow py-2 pb-3">
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
                <hr/>
            </div>
        </section>


        <hr/> <br/> <hr/>
        <section class="bg-white"
        >
            <div class="row d-flex">
                <div class="col-sm-4">
                    <h5>Available Jobs</h5>
                </div>
                <div class="col-sm-8">
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
            <div class="col-md-3 mb-3 shadow-lg ">
                <div class="card deccided-height  ">
                    <div class="card-body  ">
                        <a href="{{ route ('vacancy.details', [$vacancy->employer_id, $vacancy->category_id, $implodedTitle ]) }}" class="text-dark">{{ $vacancy->role_title }}
                                <small>
                                    <p>
                                        {{ substr($vacancy->summary,  0, 100)}}
                                    </p>
                                </small>
                            </a>
                            <address> Location: {{$vacancy->state->state_name}} State</address>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </section>
    @endsection
