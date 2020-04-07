@php
    $range = 49000;
@endphp
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @if(isset($ApplicantTotalExperiences) && count($ApplicantTotalExperiences) > 0)
        <div class="col-md">
            <div class="card">
                <div class="card-header">{{Auth::user()->name}} Profile Page</div>
                <div id="accordion">
                    @foreach($ApplicantTotalExperiences as $key => $experienceOne)
                    <div class="card">
                            <div class="card-header" id="headingThree{{$experienceOne->experience_id}}">
                                <div class="row justify-content-center">
                                    <div class="col-md-6 offset-md-3">
                                        <h5 class="mb-0">
                                            <button class="btn btn-success collapsed" data-toggle="collapse" data-target="#collapseThree-{{$experienceOne->experience_id}}" aria-expanded="false" aria-controls="collapseThree3{{$experienceOne->experience_id}}">
                                             Experience Details {{$key+1}}
                                            </button>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                            <div id="collapseThree-{{$experienceOne->experience_id}}" class="collapse" aria-labelledby="headingThree{{$experienceOne->experience_id}}" data-parent="#accordion">
                            <div class="card-body">
                                <a href="{{ route('applicant.experience-edit', [$experienceOne->experience_id,$experienceOne->applicant_id]) }}">Edit</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @else
        <p class="text-center text-info">
            You don't have record yet to manage. click on the add Experiece tabe to create an experience record
        </p>
        @endif
    </div>
</div>
@endsection

