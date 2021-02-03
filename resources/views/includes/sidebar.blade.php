<!-- Sidebar -->
    <div class="border-right" id="sidebar-wrapper">
        <div class="list-group list-group-flush">
            <div class="my-sidebar-color" id="close-side-bar">
                <i class="fas fa-arrow-right fa-2x text-white"></i> </div>
            <a href="/profile" class="my-sidebar-color">
                {{ Auth::user()->name }}
                <img class="img-circle" src="{{asset($profilePhoto)}}" alt="{{Auth::user()->profile_photo}}" width="20" height="20" class="img-circle" >
            </a>

        {{-- @if(Auth::user()->users_type == 'employer') --}}
        <a href="{{ route('employer.create_job') }}" class=" my-sidebar-color  {{ (request()->is('vacancy/create_job')) ? 'active' : '' }}"> <i class="fas fa-briefcase fa-2x"></i> Post Job</a>
        <a href="{{ route('employer.all-vacancies', Auth::user()->id ) }}" class="  my-sidebar-color  {{ (request()->is('vacancy/all-vacancies/*') || request()->is('vacancy/edit/*') || request()->is('vacancies/*')) ? 'active' : '' }}"><i class="fas fa-briefcase fa-2x"></i>Manage Posted Jobs</a>

        <a href="{{route('all-vacancies')}}" class="  my-sidebar-color  {{ (request()->is('vacancy/all-vacancy')) ? 'active' : '' }}"><i class="fas fa-briefcase fa-2x"></i>All Jobs
        </a>

        {{-- @endif --}}

        {{-- For users of type applicants --}}
       <a href="" class="text-danger">{{ Auth::user()->user_type}}</a>
        {{-- @if(Auth::user()->users_type == 'applicant') --}}
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
        {{-- @endif --}}


        <div class=" dropdown">
            <a id="navbarDropdown" class=" dropdown-toggle text-white {{ (request()->is('auth/create-photo') || request()->is('users/switch-usage') || request()->is('users/change-password')) ? 'active' : '' }}" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
               <i class="fa fa-cogs fa-2x"></i> SETTINGS
            </a>

            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a href="{{ route('users.change.passwrod') }}" class=" dropdown-item">
                    Change Password
               </a>
               <a href="{{ route('users.switch.usage') }}" class="dropdown-item"> Switch Account
                </a>
                <a href="{{ route('profile-upload') }}" class="dropdown-item">
                    Upload  Profile Picture
                </a>
                <a class="dropdown-item" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                   <i class="fas fa-sign-out-alt text-danger"></i> {{ __('Logout') }}
                </a>
            </div>
        </div>

        </div>
    </div>




