
<div class="d-flex" id="wrapper">
<!-- Sidebar -->
    <div class="bg-info  border-right" id="sidebar-wrapper">
        <div class="list-group list-group-flush">

        {{-- <div class="sidebar-heading brand-icon">JOBS  HUB
            <span class="img-circle">
                <img src="{{asset($profilePhoto)}}" alt="{{Auth::user()->profile_photo}}" width="25px" height="25" class="img-circle" >
            </span>
        </div>
          <hr> --}}
        @if(Auth::user()->users_type == 'employer')
        <a href="{{ route('employer.create_job') }}" class=" my-sidebar-color  {{ (request()->is('vacancy/create_job')) ? 'active' : '' }}"> <i class="fa fa-plus-square fa-2x"></i> Create new vacancy</a>
        <a href="{{ route('employer.all-vacancies', Auth::user()->id ) }}" class="  my-sidebar-color  {{ (request()->is('vacancy/all-vacancies/*') || request()->is('vacancy/edit/*') || request()->is('vacancies/*')) ? 'active' : '' }}"><i class="fa fa-tasks fa-2x"></i>Manage Vacancies</a>
        
        @endif

        {{-- For users of type applicants --}}
       <a href="" class="text-danger">{{ Auth::user()->user_type}}</a>
        @if(Auth::user()->users_type == 'applicant')
            @if(!isset($applicantInfo->user_id))
            <a href="{{ route('applicant.data-create', [Auth::user()->id]) }}" class="  my-sidebar-color  {{ (request()->is('creating-profile/*')) ? 'active' : '' }}"> <i class="fa fa-plus fa-2x"></i> Create Profile</a>
            @else
            <a href="{{route('applicant.data-edit',[$applicantInfo->applicant_id, $applicantInfo->user_id]) }}" class="  my-sidebar-color  {{ (request()->is('applicants/edit-profile/*')) ? 'active' : '' }}">
                <i class="fas fa-tasks fa-2x"></i>Manage Profile
            </a>



            <a href="{{route('applicant.experience-add', [$applicantInfo->applicant_id, $applicantInfo->user_id]) }}" class="  my-sidebar-color  {{ (request()->is('applicants/creating-experience/*')) ? 'active' : '' }}"><i class="fa fa-plus-square fa-2x"></i> Add Experience
            </a>


            <a href="{{route('applicant.experience-all',[$applicantInfo->applicant_id, $applicantInfo->user_id]) }}" class="  my-sidebar-color  {{ (request()->is('applicants/managing-eperience/*')) ? 'active' : '' }}"><i class="fas fa-tasks fa-2x"></i> Manage Experience
            </a>

            <a href="{{route('applicant.education-create',[$applicantInfo->applicant_id, $applicantInfo->user_id]) }}" class="  my-sidebar-color  {{ (request()->is('applicants/creating-education/*')) ? 'active' : '' }}"><i class="fa fa-plus-square fa-2x"></i> Add Education
            </a>


            <a href="{{route('applicant.education-all',[$applicantInfo->applicant_id, $applicantInfo->user_id]) }}" class="  my-sidebar-color  {{ (request()->is('applicants/viewing-education/*')) ? 'active' : '' }}"><i class="fas fa-tasks fa-2x"></i> Manage Education
            </a>

            <a href="{{route('applicant.create-cv',[Auth::user()->id]) }}" class="  my-sidebar-color  {{ (request()->is('applicants/resume/*')) ? 'active' : '' }}"><i class="fas fa-upload fa-2x"></i> Resume
            </a>

            <a href="{{route('create.alert.preference',[Auth::user()->id]) }}" class="  my-sidebar-color  {{ (request()->is('
            applcants/create/alert-preference')) ? 'active' : '' }}"><i class="fa fa-calendar-plus fa-2x"></i> Alert Preference
            </a>

            <a href="{{route('applicant.create-skills',[Auth::user()->id]) }}" class="  my-sidebar-color  {{ (request()->segment(2) == 'skills') ? 'active' : '' }}"><i class="fa fa-plus-square fa-2x"></i> Add Skills
            </a>
            @endif
        @endif
        <a href="{{route('all-vacancies')}}" class="  my-sidebar-color  {{ (request()->is('vacancy/all-vacancy')) ? 'active' : '' }}"><i class="fa fa-eye fa-2x"></i> View All Jobs
        </a>
        
        <div class=" dropdown">
            <a id="navbarDropdown" class=" dropdown-toggle text-white {{ (request()->is('auth/create-photo') || request()->is('users/switch-usage') || request()->is('users/change-password')) ? 'active' : '' }}" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
               <i class="fa fa-cogs fa-2x"></i> SETTINGS
            </a>
        
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a href="{{ route('users.change.passwrod') }}" class=" dropdown-item  my-sidebar-color text-dark">
                    Change Password
               </a>
               <a href="{{ route('users.switch.usage') }}" class="dropdown-item  my-sidebar-color text-dark"> Switch Account
                </a>
                <a href="{{ route('profile-upload') }}" class="dropdown-item  my-sidebar-color text-dark"> 
                    Upload  Profile Picture
                </a>
            </div>
        </div>
    </div>
</div>




