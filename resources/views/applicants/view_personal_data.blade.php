<div class="card p-3 border-0">
        <div class="card-header bg-white" id="view-personal-data-details">
            <div class="row justify-content-center">
                <div class="col-md-6 offset-md-3 d-flex justify-content-center">
                    <h5 class="mb-0">
                        <button class="btn btn-readmore collapsed" data-toggle="collapse" data-target="#view-personal-data" aria-expanded="false" aria-controls="view-personal-data">
                      <i class="fa fa-eye fa-2x"></i>  View Profile Information
                        </button>
                    </h5>
                </div>
            </div>
        </div>
        <div id="view-personal-data" class="collapse" aria-labelledby="view-personal-data" data-parent="#accordion">
            <div class="card-body shadow-lg border border-dark">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body shadow-lg">
                                <h6 class="text-center">Names: {{$oldApplicantRecord->first_name}}
                                        {{$oldApplicantRecord->other_names}}
                                </h6>
                                <h6 class="text-center">
                                    Professional Title: {{$oldApplicantRecord->designation}}
                                </h6>
                            </div>
                        </div>
                    </div>
                    @if($oldApplicantRecord->about_applicant != null)
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body shadow-lg">
                                <h4>About {{$oldApplicantRecord->first_name}}</h4> <hr/>
                                <article>
                                   {{$oldApplicantRecord->about_applicant}}
                                <article>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>

                <div class="row justify-content-center">

                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body shadow">
                                <h4 class="text-center">Skills</h4> <hr/>
                                <ul class=" pl-4" id="skills">
                                    @foreach (explode(',', $oldApplicantRecord->skills) as $skill)
                                        <li class="ml-3">{{strtolower($skill)}} </li>

                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body shadow-lg">
                                <address>
                                    <h4 class="text-center">Contact Address</h4> <hr/>
                                    <ul class="text-center">
                                        <li>
                                            Current Location: {{$oldApplicantRecord->state->state_name}} State
                                        </li>

                                        <li>
                                            Contact Phone Number: &nbsp; <strong>{{$oldApplicantRecord->phone}}</strong>
                                        </li>
                                        <li>
                                            Contact Email Address:  &nbsp;
                                            <a href="mailTo: {{$oldApplicantRecord->applicant_email}}">
                                                <strong>{{$oldApplicantRecord->applicant_email}} </strong>
                                            </a>
                                        </li>
                                    </ul>
                                <address>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
