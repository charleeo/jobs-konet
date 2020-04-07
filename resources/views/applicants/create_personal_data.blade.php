<div class="card">
        <div class="card-header" id="headingOne">
            <div class="row justify-content-center">
                <div class="col-md-6 offset-md-3">
                    <h5 class="mb-0">
                        <button class="btn btn-success text-center" data-toggle="collapse" data-target="#personalData" aria-expanded="true" aria-controls="personalData">
                        @if(empty($applicantInfo->user_id))
                        Create Your Profile
                        @elseif(Request::is('applicants/edit*'))
                                Edit Your Profile
                        @endif
                        </button>
                    </h5>
                </div>
            </div>
        </div>
        <div id="personalData" class="collapse " aria-labelledby="headingOne" data-parent="#accordion">
            <div class="card-body">
                <form action="{{((Request::is('applicants/edit-profile/*'))? route('applicant.data-update', [$oldApplicantRecord->applicant_id]): route('applicant.peronal.data')) }}" method="POST">
                    @csrf
                    {{ ((Request::is('applicants/edit-profile/*'))? method_field('PATCH') : "") }}
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="designation">Designation</label>
                                <select name="designation" id="" class="form-control">
                                    <option value="">please select</option>
                                    @foreach ($designations as $designation)
                                        <option value="{{ $designation }}"
                                        {{ old('designation') == $designation ? 'selected' : '' }}
                                        @if(isset($oldApplicantRecord->designation) && $oldApplicantRecord->designation == $designation)
                                        {{ 'selected'}}
                                        @endif
                                        > {{ $designation }}            </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="gender">Gender</label>
                                <select name="gender" id="" class="form-control">
                                    <option value="">please your genger</option>
                                    @foreach ($gender as $sex)
                                        <option value="{{ $sex }}"
                                        {{ old('gender') == $sex ? 'selected' : '' }}
                                        @if(isset($oldApplicantRecord->gender) && $oldApplicantRecord->gender == $sex)
                                        {{ 'selected'}}
                                        @endif

                                        >{{ $sex}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="first_name">Frst Name</label>
                                <input type="text" name="first_name" class="form-control" value="{{ old('first_name', (isset($oldApplicantRecord->first_name))? $oldApplicantRecord->first_name : '') }} ">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="other_names">Last Name</label>
                                <input type="text" name="other_names" class="form-control"
                                value="{{ old('other_names', (isset($oldApplicantRecord->other_names))? $oldApplicantRecord->other_names : '') }}"
                                >
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="birth_date">Date of Birth</label>
                                <input type="date" name="birth_date" class="form-control"
                                value="{{ old('birth_date', (isset($oldApplicantRecord->birth_date))? $oldApplicantRecord->birth_date : '') }}" >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="state_id">State of Residence</label>
                                <select name="state_id" id="" class="form-control">
                                    <option value="">please select your state</option>
                                    @foreach ($states as $state)
                                        <option value="{{ $state->state_id }}"
                                        {{ old('state_id') == $state->state_id ? 'selected' : '' }}
                                        @if(isset($oldApplicantRecord->state_id) && $oldApplicantRecord->state_id == $state->state_id)
                                        {{ 'selected'}}
                                        @endif
                                        >{{ $state->state_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="about_applicant">Yourself in brief (optional)</label>
                                <textarea name="about_applicant" class="form-control" id="" cols="30" rows="10">{{ old('about_applicant', (isset($oldApplicantRecord->about_applicant))? $oldApplicantRecord->about_applicant : '') }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="applicant_email">Application Email Address</label>
                                <input type="text" name="applicant_email" class="form-control" placeholder="please enter the email addressyou wish to apply with"
                                value="{{ old('applicant_email', (isset($oldApplicantRecord->applicant_email))? $oldApplicantRecord->applicant_email : '') }}"
                                >
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="text" name="phone" class="form-control" placeholder="Your phone number"
                                value="{{ old('phone', (isset($oldApplicantRecord->phone))? $oldApplicantRecord->phone : '') }}"
                                >
                            </div>
                        </div>
                        <div class="col-md-2 offset-md-2 mt-1">
                            <label for=""></label>
                            <div class="form-group">
                               <button class="form-control btn btn-success">Save</button>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name='user_id'value='{{ Auth::user()->id }}'>
                </form>
            </div>
        </div>
    </div>
