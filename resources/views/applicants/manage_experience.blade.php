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
                {{-- <div class="card-header">{{Auth::user()->name}} Profile Page</div> --}}
                <div id="accordion">
                    @foreach($ApplicantTotalExperiences as $key => $experienceOne)
                    <div class="card">
                            <div class="card-header" id="headingThree{{$experienceOne->experience_id}}">
                                <div class="row justify-content-center">
                                    <div class="col-md-6 offset-md-3">
                                        <h5 class="mb-0">
                                            <button class="btn btn-dark collapsed" data-toggle="collapse" data-target="#collapseThree-{{$experienceOne->experience_id}}" aria-expanded="false" aria-controls="collapseThree3{{$experienceOne->experience_id}}">
                                                {{$experienceOne->employer_name}} Experience Information 
                                            </button>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                            <div id="collapseThree-{{$experienceOne->experience_id}}" class="collapse" aria-labelledby="headingThree{{$experienceOne->experience_id}}" data-parent="#accordion">
                            <div class="card-body">
                                <table class="table table-stripped table-bordered">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <a href="{{ route('details.experience', [$experienceOne->experience_id,$experienceOne->applicant_id]) }}" class="text-info"> <i class="fa fa-eye fa-2x"></i> Details</a>
                                            </td>

                                            <td>
                                                <a href="{{ route('applicant.experience-edit', [$experienceOne->experience_id,$experienceOne->applicant_id]) }}"> <i class="fa fa-pencil fa-2x"></i> Edit</a>
                                            </td>

                                            <td>
                                                <a href="{{ route('delete.experience', [$experienceOne->experience_id,$experienceOne->applicant_id]) }}" class="text-danger"> <i class="fa fa-trash fa-2x"></i> Delete</a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
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

