@php
    $range = 49000;
@endphp
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @if(isset($educations) && count($educations) > 0)
        <div class="col-md">
            <div class="card">
                <div class="card-header">{{Auth::user()->name}} Profile Page</div>
                <div id="accordion">
                    @foreach($educations as $key => $education)
                    <div class="card">
                            <div class="card-header" id="headingThree{{$education->education_id}}">
                                <div class="row justify-content-center">
                                    <div class="col-md-6 offset-md-3">
                                        <h5 class="mb-0">
                                            <button class="btn btn-success collapsed" data-toggle="collapse" data-target="#collapseThree-{{$education->education_id}}" aria-expanded="false" aria-controls="collapseThree3{{$education->education_id}}">
                                             Experience Details {{$key+1}}
                                            </button>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                            <div id="collapseThree-{{$education->education_id}}" class="collapse" aria-labelledby="headingThree{{$education->education_id}}" data-parent="#accordion">
                            <div class="card-body">
                                <a href="{{ route('applicant.education-edit', [$education->education_id,$education->applicant_id]) }}">Edit</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @else
        <p class="text-center text-info">
            You don't have record yet to manage. click on the add Education tabe to create an education record
        </p>
        @endif
    </div>
</div>
@endsection

