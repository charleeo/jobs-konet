@extends('layouts.app')

@section('content')

<div class="row justify-content-center px-5">
    <div class="col-md">
        <h6>
            <a href="{{route('all-vacancies')}}" class="text-info">
                <i class="fas fa-arrow-left fa-lg "></i> Back
            </a>
        </h6>
    </div>
</div>

<div class="row shadow-lg d-flex flex-wramp px-5" >
        @foreach ($vacancies as $vacancy)
        @php
            $explodedTitle = explode(' ', $vacancy->role_title) ;
            $implodedTitle = implode('-', $explodedTitle)
        @endphp
        <div class="col-md-3 py-3 ">
            <div class="card  shadow-lg deccided-height  ">
                <div class="card-body shadow-lg border border-dark">
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
@endsection
