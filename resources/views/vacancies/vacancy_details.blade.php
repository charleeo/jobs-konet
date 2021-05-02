@extends('layouts.app')

@section('content')

    @php
        $re = '/(?<!e.g)(?<=[.!?]|[.!?][\'"])\s+(?=\S)/';
        // $re2 = '/(?<=[.!?])\s+(?=\S)/';
        $paragraphs = preg_split($re, $vacancy->description, -1);
        $requirements = preg_split($re, $vacancy->requirements, -1);
        $descriptions = preg_split($re, $vacancy->description, -1);
        $skills_and_qualifications = explode('.', $vacancy->skills_and_qualifications, -1);
        $working_hours = preg_split($re, $vacancy->working_hours, -1);
    @endphp
    <hr>


<div class="row   px-4 justify-content-center mb-2">
    <div class="col-md-5 ">
        <div class="card shadow">
            <div class="card-body   border-0">
                <h2 class="card-text text-center">
                    Industry:
                    <strong>
                            {{ $vacancy->category->category_name }}
                    </strong>
                </h2> <hr>
                {{-- <i class="fas fa-briefcase fa-4x text-secondary"></i> --}}
                <h3 class="">Title: {{ $vacancy->role_title }}</h3>
                <p>By: <strong>{{ $vacancy->user->name }}</strong></p>
                <p>Category:  {{ $vacancy->category->category_name }} </p>
                <span>State: {{ $vacancy->state->state_name }}</span> | <span>{{$vacancy->engagement}}</span>
            </div>
        </div>
    </div>

    <div class="col-md-6 mb-4">
        <div class="card">
            <div class="card-body">
                <h4 class="pl-3">Job Summary</h4>
                <p> {!! html_entity_decode($vacancy->summary) !!} </p>
                <hr>
                <ul>
                    <li>Experience Length: <strong>{{ $vacancy->min_experience }} </strong></li>
                    <li>Experience Level: <strong> {{ $vacancy->experience_level }}</strong> </li>
                    <li>Minimum Qulification: <strong> {{ $vacancy->min_qualification }} </strong> </li>
                    <li>Salary: <strong>{{$vacancy->salary}}</strong></li>
                    <li>Dead-Line: <strong>{{date_format(date_create($vacancy->clossing_date), '\O\n l jS \of\ F Y')}}</strong></li>
                </ul>
            </div>
        </div>
    </div>



<div class="row px-4 justify-content-end">

    <div class="col-md-5 mb-5 px-5">
        {{-- Skills Sets --}}
        <div class="card">
            <div class="card-body  shadow-lg border">
                <h4>Skills And Qulifications</h4>
                <ul>
                    @foreach ($skills_and_qualifications as $skills)
                        <li> {!! html_entity_decode($skills ) !!} .</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
{{-- </div> --}}

    {{-- Requirements --}}
<div class="row px-4  justify-content-center mb-2">
    <div class="col-md-5 mb-4">
        <div class="card">
            <div class="card-body  shadow-lg border">
                <h4> Education And Experience Requirements</h4>
                <ul>
                    @foreach ($requirements as $required)
                    <li>{!! html_entity_decode($required) !!}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        {{-- Working hours and benefit --}}
        <div class="card">
            <div class="card-body  shadow-lg border">
                <h4>Working Hours And Benefits</h4>
                <ul>
                    @foreach ($working_hours as $hour)
                        <li> {!! html_entity_decode($hour) !!} </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
{{-- </div> --}}



<hr>
 @include('includes.application_steps')
<hr>


{{-- Jobs in the same industry category --}}

<hr>
    @include('includes.related_jobs')
@endsection
