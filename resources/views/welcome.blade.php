@extends('layouts.app')

@section('content')
<main>
    <section class="home">
        <svg height="150" width="500">
            <ellipse cx="140" cy="100" rx="120" ry="30" style="fill:#ae3422" />
            <ellipse cx="120" cy="70" rx="90" ry="20" style="fill:#0b778a" />
            <ellipse cx="110" cy="45" rx="70" ry="15" style="fill:#000005" />
            Sorry, your browser does not support inline SVG.
        </svg>
        <h1 class="home_name text-light">
                <span class="home_name--last"> {{ config('app.name', 'MultiAuth') }}</span> Bridging The Gap
        </h1>
        <h2>Accesses to industrial top talents simplified</h2>
        <p class="text-center alert text-danger shadow-lg">Check Out Some Top Talents and Awsome JObs <i class="fas fa-arrow-down text-light fa-lg"></i> </p>

    </section>
</main>
        <hr>
        <section class="jumbotron">
            <div class="row">
                <div class="col-md-4">
                    <h5>Available Talents</h5>
                </div>
                <div class="col-md-8">
                    <div class="   text-center">
                        <a href="{{route('all-vacancies')}}" class="text-dark">Applicants CORNER FOR MORE</a>
                    </div>
                </div>
            </div>
            <div class="row shadow-lg d-flex flex-wramp" >
            @foreach ($vacancies as $vacancy)
            @php
                $explodedTitle = explode(' ', $vacancy->role_title) ;
                $implodedTitle = implode('-', $explodedTitle)
                @endphp
            <div class="col-md-3 shadow-lg ">
                <div class="card    deccided-height  ">
                    <div class="card-body  ">
                        <a href="{{ route ('vacancy.details', [$vacancy->employer_id, $vacancy->category_id, $implodedTitle ]) }}" class="text-dark">{{ $vacancy->role_title }}
                                <h6 class="text-center">
                                </h6 class="text-center">
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
            <div class="row justify-content-center mt-2">


            </div>
        </section>
        <section class="jumbotron">
            <div class="row">
                <div class="col-md-4">
                    <h5>Available Jobs</h5>
                </div>
                <div class="col-md-8">
                    <div class="   text-center">
                        <a href="{{route('all-vacancies')}}" class="text-dark">VACANCIES CORNER FOR MORE</a>
                    </div>
                </div>
            </div>
            <div class="row shadow-lg d-flex flex-wramp" >
            @foreach ($vacancies as $vacancy)
            @php
                $explodedTitle = explode(' ', $vacancy->role_title) ;
                $implodedTitle = implode('-', $explodedTitle)
                @endphp
            <div class="col-md-3 shadow-lg ">
                <div class="card    deccided-height  ">
                    <div class="card-body  ">
                        <a href="{{ route ('vacancy.details', [$vacancy->employer_id, $vacancy->category_id, $implodedTitle ]) }}" class="text-dark">{{ $vacancy->role_title }}
                                <h6 class="text-center">
                                </h6 class="text-center">
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
            <div class="row justify-content-center mt-2">


            </div>
        </section>
    @endsection
