@extends('layouts.app')

@section('content')
        <section class="pl-4 ">
            <div class="row d-flex justify-content-center">
                <div class="col-md-7">
                    <h4 class="text-center">
                        <a href="/" class="text-dark"> Return  Back</a>
                    </h4>
                </div>
            </div>

            <div class="row  d-flex flex-wramp justify-content-center " >
            <div class="col-md-12 mb-3  ml-2" >
                <div class="align-self-center ">
                    <div class="row">
                        <div class="col-md-4 shadow py-3 ">
                            <h6 class="text-center">{{$applicant->first_name}}
                                    {{$applicant->other_names}}
                                </h6>
                                <h6 class="text-center">
                                    Professional Title: {{$applicant->designation}}
                                </h6>
                                <hr>
                                <h6 class="text-center border-bottom">About {{$applicant->first_name}} {{$applicant->other_names}}</h6>
                                <p>{{$applicant->about_applicant}}</p>
                                <hr>
                            </div>
                        {{-- Image and Title --}}
                        <div class="col-md-5    py-2 pb-3">
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <h6 class="text-center">
                                            <img src="{{asset('images/profile_pics/'.$applicant->user->profile_photo)}}" alt="profile image" class="rounded" width="200" height="150">
                                        </h6>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <ul class="text-center">
                                            <li>
                                                Current Location: {{$applicant->state->state_name}} State
                                            </li>

                                            <li>
                                                Contact Phone Number: &nbsp; <strong>{{$applicant->phone}}</strong>
                                            </li>
                                            <li>
                                                Contact Email Address:  &nbsp;
                                                <a href="mailTo: {{$applicant->applicant_email}}">
                                                    <strong>{{$applicant->applicant_email}} </strong>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                        {{-- Skills --}}
                        <div class="col-md-3 shadow py-2 pb-3">
                            <div class="row">
                                <div class="col ">
                                    <h6 class="text-center">Skills:</h6> <hr/>
                                    <ul class=" pl-4" id="skills">
                                        @foreach (explode(',', $applicant->skills) as $skill)
                                            <li class="ml-3">{{strtolower($skill)}} </li>

                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
    </section>
    <section class="pl-4">
        @foreach($experiences as $experience)
        <h1 class="text-center">Work History</h1> <hr>
        <div class="row justify-content-content">
            <div class="col-md-6 border-right">
                <h4>Detailed Information</h4>
                <h6>Role Title: {{$experience->job_title}}</h6>
                <small>
                  <p> <b>Engagemnet Time: &nbsp;</b> {{$experience->start_month}} Of {{$experience->start_year}} &nbsp; --- &nbsp;
                @if($experience->still_working_there == 'no')
                    {{$experience->end_month}}  {{$experience->end_year}}</p>
                    @else
                    Date
                @endif
                </small>
                <h6>Employer : {{$experience->employer_name}}</h6>
                <small>
                    <hr>
                    Department: {{$experience->department}} <br/>
                    Engagemnet Type: {{$experience->engagement_type}} <br/>
                    Industry: {{$experience->category->category_name}} <br/>
                </small>
            </div>
            <div class="col-md-6">
                <h4>Work Description</h4>
                <p>{{$experience->work_description}}</p>
            </div>
        </div>
        @endforeach
    </section>
    @endsection
