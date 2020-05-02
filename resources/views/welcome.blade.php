@extends('layouts.app')

@section('content')
<main>
    <section class="home">
        <header>
            <div class="row d-flex">
                <div class="col-md-12">
                    <h1 class="home_name">
                        <small class="text text-dark">Welcome To</small>
                        <span class="home_name--last"> {{ config('app.name', 'MultiAuth') }}</span>
                    </h1>
                    <h4 class=" text-dark  py-4">We Link Greate Skills With Greate Gigs</h4>
                </div>
            </div>
            <h2 class="text-info">The best Talents and Jobs at your finger tip</h2>
        </header>
        <button class="mt-4">
            <a href="#employee"> Details Here
                <i class="fas fa-arrow-down text-info fa-lg"></i>
            </a>
        </button>
    </section>
</main>
        <hr/><br/> <br/>

        <section class="pl-4 employees pt-4" id="employee">
            <div class="row d-flex justify-content-center border-bottom">
                <div class="col-md-3"><h4 class="text text-center">Potential Employees</h4></div>
                <div class="col-md-7">
                    <h4 class="text-center">
                        <a href="{{route('applicant.all')}}" class="btn btn-info border pl-2 pr-2"> Visit Employees Corner For More</a>
                    </h4>
                </div>
            </div> <br>

            <div class="row  d-flex flex-wramp " >
            @foreach ($applicantsHomeView as $applicant)

            <div class="col-md-5 mb-3  ml-2" >
                <div class="align-self-center ">
                    <div class="row">
                        {{-- Image and Title --}}
                        <div class="col-sm-5  shadow py-2 pb-3">
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
                            <button class="button" >
                            <a href="{{route('applicant.details', [$applicant->applicant_id])}}" >Detail Here
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
        <section class="pl-4">
            <div class="row d-flex">
                <div class="col-sm-4">
                    <h5>Available Jobs</h5>
                </div>
                <div class="col-sm-8">
                    <div class=" ">
                        <a href="{{route('all-vacancies')}}" class="btn btn-info text-light">VACANCIES CORNER FOR MORE</a>
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
