<section class="pl-4 ">
    
    <div class="row  d-flex flex-wramp justify-content-center bg-white " >
    <div class="col-md-12 mb-3  ml-2" >
        <div class="align-self-center ">
            <div class="row">
                <div class="col-md-12  py-3 ">
                    <h6 class="text-center">{{$applicant->first_name}}
                            {{$applicant->other_names}}
                    </h6>
                        <h6 class="text-center">
                            Professional Title: {{$applicant->designation}}
                        </h6>
                        @if (!empty($applicant->about_applicant))

                        <hr>
                        <h6 class="text-center ">About {{$applicant->first_name}} {{$applicant->other_names}}</h6>
                        <p>{{$applicant->about_applicant}}</p>
                        @endif

                    </div>
                {{-- Image and Title --}}
                <div class="col-md-12    py-2 pb-3">
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
                <div class="col-md-12 shadow py-2 pb-3">
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
<div class="col-md">
    <div class="card">

        <div id="accordion">
            @foreach($experiences as $key => $experience)
            <div class="card">
                    <div class="card-header bg-white shadow" id="headingThree{{$experience->experience_id}}">
                        <div class="row justify-content-center">
                            <div class="col-md-6 offset-md-3">
                                <h5 class="mb-0">
                                    <button class="btn btn-readmore collapsed" data-toggle="collapse" data-target="#collapseThree-{{$experience->experience_id}}" aria-expanded="false" aria-controls="collapseThree3{{$experience->experience_id}}">
                                        Work Experience {{$key +1}}
                                    </button>
                                </h5>
                            </div>
                        </div>
                    </div>
                    <div id="collapseThree-{{$experience->experience_id}}" class="collapse" aria-labelledby="headingThree{{$experience->experience_id}}" data-parent="#accordion">
                    <div class="card-body">
                        <div class="row justify-content-content  shadow-lg bg-white p-4">
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
                                <p>{!! html_entity_decode($experience->work_description)!!}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

</section>

<section class="pl-4 mt-3 ">
<div class="col-md ">
    {{-- <div class="card bg-white"> --}}
      <div id="accordion" >
          @foreach($educations as $key=> $education)
          <div class="card ">
                  <div class="card-header bg-white shadow" id="headingThree{{$education->education_id}}">
                      <div class="row justify-content-center">
                          <div class="col-md-6 offset-md-3">
                              <h5 class="mb-0">
                                  <button class="btn btn-readmore collapsed" data-toggle="collapse" data-target="#collapseThree-{{$education->education_id}}" aria-expanded="false" aria-controls="collapseThree3{{$education->education_id}}">
                                       Education Information  {{$key+1}}
                                  </button>
                              </h5>
                          </div>
                      </div>
                  </div>
                  <div id="collapseThree-{{$education->education_id}}" class="collapse" aria-labelledby="headingThree{{$education->education_id}}" data-parent="#accordion">
                  <div class="card-body">
                      <div class="row justify-content-content mb-4 shadow-lg bg-white py-4 px-4">
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
                  </div>
              </div>
          </div>
          @endforeach
      </div>
      {{-- </div> --}}
  </div>
</section>
<hr>
<div class="alert alert-secondary text-center">
<button type="button" class="btn btn-readmore" data-toggle="modal" data-target="#exampleModal">
            Reach Out to    {{$applicant->other_names}}
</button>
</div>
@include('includes.modal')
