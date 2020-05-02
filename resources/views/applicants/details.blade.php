@extends('layouts.app')

@section('content')
        <section class="pl-4 ">
            <div class="row d-flex justify-content-center">
                <div class="col-md-7">
                    <h4 class="text-center">
                        <a href="{{ route('applicant.all') }}" class="text-dark"> <i class="fas fa-arrow-left"></i> Return  Back</a>
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
                                <h6 class="text-center ">About {{$applicant->first_name}} {{$applicant->other_names}}</h6>
                                <p>{{$applicant->about_applicant}}</p>

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


        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModal">
                Reach Out
        </button>

        <hr>
    </section>
    <section class="pl-4">
        @foreach($experiences as $key=> $experience)
        <h3 class="text-center">Work Experience {{ (count($experiences) > 1)? ($key+1):"" }} </h3>
        <div class="row justify-content-content mb-4 shadow-lg p-4">
            <div class="col-md-6 border">
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
            <div class="col-md-6 border">
                <h4>Experience Description</h4>
                <p>{{$experience->work_description}}</p>
            </div>
        </div>
        @endforeach
        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModal">
                Reach Out
        </button>

    </section>
    <br>
    <br>
    <br>
    <section class="pl-4">
        @foreach($educations as $key=> $education)
        {{-- {{dd($education)}} --}}
        <h3 class="text-center">Education  {{ (count($educations) > 1)? ($key+1) :"" }}</h3>
        <div class="row justify-content-content mb-4 shadow-lg py-4 px-4">
            @if($education->brief_description !=null)
            <div class="col-md-6 border">
            @else
            <div class="col-md-4 offset-md-4 border mb-4 pt-4">
            @endif
                <h4>Detailed Information</h4>
                <h6>Institution Attended: {{$education->institution}}</h6>
                <small>
                  <p> <b>Started: &nbsp;</b> {{$education->start_month}},  {{$education->start_year}}
                  </p>
                <p>
                Ended:
                @if($education->still_studying == 'no')
                    {{$education->end_month}},  {{$education->end_year}}</p>
                    @else
                    In Progress
                @endif
                </small>
                <h6>Course Of Study : {{$education->department}}</h6>
            </div>
            @if($education->brief_description !=null)
            <div class="col-md-6 border ">
                <h4>Breif Description</h4>
                <p>{{$education->brief_description}}</p>
            </div>
            @endif
        </div>
        @endforeach
    </section>
    <hr>
    @endsection




      <!-- Modal -->
      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Applicants Reach Out Form</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                    @include('includes.reach_out')
            </div>
          </div>
        </div>
      </div>
