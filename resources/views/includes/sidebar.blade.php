
<div class="d-flex" id="wrapper">
<!-- Sidebar -->
    <div class="bg-info shadow-lg border-right" id="sidebar-wrapper">
        <div class="list-group list-group-flush">
        <div class="sidebar-heading brand-icon">JOBS HUB
            <span class="img-circle">
                <img src="{{asset($profilePhoto)}}" alt="{{Auth::user()->profile_photo}}" width="25px" height="25" class="img-circle" >
            </span>
        </div>
          <hr>
        @if(Auth::user()->users_type == 'employer')
        <a href="{{ route('employer.create_job') }}" class="list-group-item list-group-item-action my-sidebar-color shadow-lg {{ (request()->is('vacancy/create_job')) ? 'active' : '' }}">Post A Vacancy</a>
        <a href="{{ route('employer.all-vacancies', Auth::user()->id ) }}" class="list-group-item list-group-item-action my-sidebar-color shadow-lg {{ (request()->is('vacancy/all-vacancies/*')) ? 'active' : '' }}">Manage All Vacancies</a>
        <a href="{{route('users.edit-profile',['id'=> Auth::user()->id]) }}" class="list-group-item list-group-item-action my-sidebar-color shadow-lg {{ (request()->is('profile/edit/*')) ? 'active' : '' }}">Edit Profile</a>
        @endif

        {{-- For users of type applicants --}}
        @if(Auth::user()->users_type == 'applicant')

            @if(!isset($applicantInfo->user_id))
            <a href="{{ route('applicant.data-create', [Auth::user()->id]) }}" class="list-group-item list-group-item-action my-sidebar-color shadow-lg {{ (request()->is('creating-profile/*')) ? 'active' : '' }}">Create Profile</a>
            @else
            <a href="{{route('applicant.data-edit',[$applicantInfo->applicant_id, $applicantInfo->user_id]) }}" class="list-group-item list-group-item-action my-sidebar-color shadow-lg {{ (request()->is('applicants/edit-profile/*')) ? 'active' : '' }}">Manage Profile Information
            </a>



            <a href="{{route('applicant.experience-add', [$applicantInfo->applicant_id, $applicantInfo->user_id]) }}" class="list-group-item list-group-item-action my-sidebar-color shadow-lg {{ (request()->is('applicants/creating-experience/*')) ? 'active' : '' }}">Add Experience
            </a>


            <a href="{{route('applicant.experience-all',[$applicantInfo->applicant_id, $applicantInfo->user_id]) }}" class="list-group-item list-group-item-action my-sidebar-color shadow-lg {{ (request()->is('applicants/managing-eperience/*')) ? 'active' : '' }}">Manage Your Experience
            </a>

            <a href="{{route('applicant.education-create',[$applicantInfo->applicant_id, $applicantInfo->user_id]) }}" class="list-group-item list-group-item-action my-sidebar-color shadow-lg {{ (request()->is('applicants/creating-education/*')) ? 'active' : '' }}">Add Education
            </a>


            <a href="{{route('applicant.education-all',[$applicantInfo->applicant_id, $applicantInfo->user_id]) }}" class="list-group-item list-group-item-action my-sidebar-color shadow-lg {{ (request()->is('applicants/viewing-education/*')) ? 'active' : '' }}">Manage Your Education
            </a>

            <a href="{{route('users.edit-profile',['id'=> Auth::user()->id]) }}" class="list-group-item list-group-item-action my-sidebar-color shadow-lg {{ (request()->is('profile/edit/*')) ? 'active' : '' }}">Edit Profile
            </a>

            <a href="{{route('applicant.create-cv',[Auth::user()->id]) }}" class="list-group-item list-group-item-action my-sidebar-color shadow-lg {{ (request()->is('applicants/resume/*')) ? 'active' : '' }}">Upload A Resume
            </a>

            <a href="{{route('applicant.create-skills',[Auth::user()->id]) }}" class="list-group-item list-group-item-action my-sidebar-color shadow-lg {{ (request()->segment(2) == 'skills') ? 'active' : '' }}">Add Skills To Your Profile
            </a>
            @endif
        @endif
        <a href="{{route('all-vacancies')}}" class="list-group-item list-group-item-action my-sidebar-color shadow-lg {{ (request()->is('vacancy/all-vacancy')) ? 'active' : '' }}">See Available Jobs Here
        </a>

        <a href="{{ route('users.change.passwrod') }}" class="list-group-item list-group-item-action my-sidebar-color shadow-lg {{ (request()->is('users/change-password')) ? 'active' : '' }}">Change Password</a>
        <a href="{{ route('profile-upload') }}" class="list-group-item list-group-item-action my-sidebar-color shadow-lg {{ (request()->is('auth/create-photo')) ? 'active' : '' }}">Upload a Profile Picture</a>
    </div>
</div>

