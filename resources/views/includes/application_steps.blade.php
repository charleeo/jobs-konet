<div class="row   justify-content-center">
{{-- @if(Auth::check() == false) --}}
<div class="col-md-5">
    <div class="card">
        <div class="card-body shadow-lg border">
            <p>
                Interested and qualify candidates should on or before  <strong> {{date_format(date_create($vacancy->clossing_date), '\t\h\e\  jS \of\ F Y')}}</strong>.
                @if(strpos($vacancy->email, '@'))
                    Forward your application to the email address below
                    <a href="mailTo:{{$vacancy->email}}"  >{{$vacancy->email}}</a>
                @else
                Visit the link below to apply on company's website.
                    @php
                        $link = $vacancy->email;

                        // if(substr($link, 0,6)  =='https://' || substr($link, 0,5 ) =='http://')
                        // {
                        //     $link = substr($link, strlen('https://'));
                        // }
                        @endphp
                    <a href="{{ $link}}" target="_blank" translate="yes"><b> {{$link}}</b></a>
                @endif
            </p>
            <div class="alert bg-dark  text-center">
                <a href="{{route('all-vacancies')}}" class="text-light">  Go Back</a>
            </div>
        </div>
    </div>
</div>
@if(strpos($vacancy->email, '@'))

<div class="col-md-6">
    <div class="card">
    @if(Auth::check() == false)
    <h5 class="text-center">Your Dream Job is closer than you can imagine</h5>
    <div class="card-body shadow-lg border">
        <div class="form-group">
            <button class="btn btn-info">Long In To Apply With Your Profile Credentials</button>
        </div>

            @include('includes.login')
        <div class="form-group">
            <button class="btn-link btn text-info">New ? </button>
            <a href="{{ route('register') }}" class="text-dark">Register Here</a>
        </div>

        {{-- For logged user whose usage type is applicant --}}
        @elseif($applicantInfo != null)

        <form action="{{ route('send-my-application', [$vacancy->employer_id, Auth::user()->id])}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row p-4">
                <div class="col-md-12">
                    <h6 class=" text-info">Quickly Apply With Your Profile Credentials</h6><hr>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="text text-info">Application Subject</label>
                        <input type="text" name="subject" class="form-control" placeholder="e.g Application For Content Management " required>
                    </div>
                </div>
                <input type="hidden" name="user_resume" id="user_resume" value="{{$applicantInfo->resume }}">
                @if($applicantInfo->resume != null)
                <div class="col-md-12">
                    <div class="form-group">
                        <p class="text text-info">Profile Resume: {{$applicantInfo->resume}}</p>
                    </div>
                </div>
                @endif
                <div class="col-md-12" id="check-div">
                    <div class="form-group">
                        <label class="text-center">Apply with a new Resume</label>
                        <input type="checkbox" name="decision_box" value="yes" id="check" class="text text-lg" >
                    </div>
                </div>
                <div class="col-md-12 letter_input" id="new_resume_div">
                    <div class="form-group">
                        <label class="text-center" id="new_resume_label">Upload a new Resume</label> &nbsp; <label class="text-center">Save this resume?</label>
                        <input type="checkbox" name="save_resume" value="yes">
                        <input type="file" name="resume" id="new_resume" class="form-control" >
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="text-center">Upload a cover letter (optional)</label>
                        <input type="file" name="uploaded_cover_letter" id="letter_to_upload"  class="form-control" >
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="text-center">Write a cover letter (optional) <i class="fas fa-plus text-dark"></i></label>

                        <textarea name="written_cover_letter" id="letter_input" cols="30" rows="10" class="form-control letter_input">{{$applicantInfo->cover_letter}}</textarea>
                    </div>

                </div>
                <div class="col-md-12 letter_input" id="save_letter">
                    <div class="form-group">
                        <label class="text-center ">Save This Letter For You? </label>
                        <input type="checkbox" name="save_letter" value="yes">
                    </div>

                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <button class="btn btn-dark">Send My Application</button>
                    </div>
                </div>
            </div>
        </form>
        @elseif(!$applicantInfo && auth::user()->users_type == 'applicant')
        <p class="pl-2">
            Please use the create profile tab at the left hand side of the screen to create some records.
        </p>
        <p class="pl-2">
            Or quickly create your profile <a href="{{route('applicant.data-create', [Auth::user()->id])}}" class="btn btn-link">here</a>
        </p>
        @endif
        @else
        <p>Use the provided address to apply</p>
        @endif
        </div>
    </div>
</div>
</div>
