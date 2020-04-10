@extends('layouts.app')

@section('content')
<main>
    <section class="home">
        <div class="row d-flex">
            <div class="col-md-12">
                <h1 class="home_name">
                    <small class="text text-dark">Welcome To</small>
                    <span class="home_name--last"> {{ config('app.name', 'MultiAuth') }}</span>
                </h1>
                <svg height="150" width="500">
                    <ellipse cx="140" cy="100" rx="120" ry="30" style="fill:#ae3422" />
                    <ellipse cx="110" cy="45" rx="70" ry="15" style="fill:#000" />
                    <ellipse cx="120" cy="70" rx="90" ry="20" style="fill:#0b778a" />
                    Sorry, your browser does not support inline SVG.
                </svg>
                <h4 class=" text-dark shadow-lg py-4">We Connect The World</h4>
            </div>
        </div>
        <h2 class="text-info">The best talents And Jobs At Your finger tip</h2>
        <p class="text-center alert text-danger shadow-lg">Check Out Some Top Talents and Awsome JObs <i class="fas fa-arrow-down text-info fa-lg"></i> </p>

    </section>
</main>
        <hr/><br/> <hr/>

        <section class="pl-4">
            <div class="row d-flex justify-content-center">
                <div class="col-md-3">
                    <h5>Available Jobs</h5>
                </div>
                <div class="col-md-7">
                    <div class=" ">
                        <a href="{{route('all-vacancies')}}" class="text-dark">VACANCIES CORNER FOR MORE</a>
                    </div>
                </div>
            </div>
            <br/>
            <div class="row  d-flex flex-wramp justify-content-center" >
            @foreach ($applicantsHomeView as $applicant)

            <div class="col-md-5 mb-3  ml-2">
                <div class="align-self-center ">
                    <div class="row">
                        {{-- Image and Title --}}
                        <div class="col-md-5  shadow py-2">
                            <h6 class=" justify-content-center">
                                <img src="{{asset('images/profile_pics/'.$applicant->user->profile_photo)}}" alt="profile image" class="rounded-circle" width="100" height="100">
                            </h6>
                            <hr>
                            <h6>{{$applicant->first_name}}
                               {{$applicant->other_names}}
                            </h6>
                            <h6>
                                Professional Title: {{$applicant->designation}}
                            </h6>
                        </div>
                        {{-- Skills --}}
                        <div class="col-md-7 shadow py-2">
                            <div class="row">
                                <div class="col ">
                                    <h6 class="text-center">Skills:</h6> <hr/>
                                    <ol class="d-flex flex-wrap pl-4" id="skills">
                                        @foreach (explode(',', $applicant->skills) as $skill)
                                            <li class="ml-3">{{$skill}}</li> &nbsp;&nbsp;
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
        <section class="pl-4">
            <div class="row d-flex">
                <div class="col-sm-4">
                    <h5>Available Jobs</h5>
                </div>
                <div class="col-sm-8">
                    <div class=" ">
                        <a href="{{route('all-vacancies')}}" class="text-dark">VACANCIES CORNER FOR MORE</a>
                    </div>
                </div>
            </div>
            <div class="row  d-flex flex-wramp" >
            @foreach ($vacancies as $vacancy)
            @php
                $explodedTitle = explode(' ', $vacancy->role_title) ;
                $implodedTitle = implode('-', $explodedTitle)
                @endphp
            <div class="col-md-3 mb-3 shadow-lg ">
                <div class="card    deccided-height  ">
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
