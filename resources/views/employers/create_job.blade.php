@extends('layouts.app')

@section('content')
<div class="container">
    {{-- This form is for both the creating and editing of the employers table --}}
    {{-- Defined some variables here --}}

    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header ">
                    <div class="row">

                        <div class="col-md-6 text-center text-dark">Vacancy {{ (Request::is('vacancy/edit/*'))?'Update' : 'Creation' }} Form</div><hr>
                        <div class="col-md-6 text-center">Note: All fields with <span class="text-danger">*</span> are required</div>
                    </div>
                </div>
                <div class="card-body shadow-lg border border-dark">

                    <form action="{{ $action }}" method="{{ (Request::is('vacancy/edit/*'))? 'POST' : 'POST' }}">
                        {{ csrf_field() }}
                        {{ ((Request::is('vacancy/edit/*'))? method_field('PATCH') : "") }}

                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="role_title">Role Title <span class="text-danger text-lg">*</span> </label>
                                    <input type="text" class="form-control" name="role_title" required id="role_title" placeholder="You can specify more than one role" value="{{ old('role_title', (isset($vacancy->role_title))? $vacancy->role_title : '' ) }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="salary"> &#8358; Salary (optional)</label>
                                    <input type="text" name="salary" class="form-control" value="{{ old('salary', (isset($vacancy->salary))? $vacancy->salary : '') }}">
                                </div>
                            </div>
                        </div>

                        {{-- Row end --}}
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="category_id">Industry Category</label>
                                    <select name="category_id" id="" class="form-control">
                                        <option value="">please select an option</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->category_id }}"
                                            {{ old('category_id') == $category->category_id? 'selected': '' }}
                                            {{ (isset($vacancy->category_id) && $vacancy->category_id == $category->category_id)? 'selected': '' }}
                                            >{{$category->category_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="summary">Job Summary <span class="text-danger text-lg">*</span> </label>

                                    <textarea name="summary" id="" placeholder="summarise the job functios here"  class="form-control editor" cols="30" rows="10">{{ old('summary', (isset($vacancy->summary))? $vacancy->summary : '') }}</textarea>
                                </div>
                            </div>
                        </div>

                        {{-- Row end --}}
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="engagement">Work Engagement Type<span class="text-danger text-lg">*</span> </label>

                                    <select type="engagement" name="engagement"  required class="form-control" >
                                        <option value="">Please select an option</option>
                                        @foreach ($engagements as $engagement)
                                        <option value="{{ $engagement }}"

                                        {{ old('engagement') == $engagement ? 'selected' : '' }}

                                        @if(isset($vacancy->engagement) && $vacancy->engagement == $engagement)
                                        {{ 'selected'}}
                                        @endif

                                        >{{ $engagement }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="experience_level">Experience Level<span class="text-danger text-lg">*</span> </label>
                                    <select type="experience_level" name="experience_level"  required class="form-control" >
                                        <option value="">Please select an option</option>
                                        @foreach ($experienceLevel as $experience)
                                        <option value="{{ $experience }}"

                                        {{ old('experience_level') == $experience ? 'selected' : '' }}

                                        @if(isset($vacancy->experience_level) && $vacancy->experience_level == $experience)
                                        {{ 'selected'}}
                                        @endif

                                        >{{ $experience }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        {{-- Row end --}}
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="min_experience">Experience Length <span class="text-danger text-lg">*</span> </label>
                                    <input type="number" min="0" name="min_experience" value="{{ old('min_experience', (isset($vacancy->min_experience))? $vacancy->min_experience : '') }}" placeholder="numbers only: specify the min experience length" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="clossing_date">Application clossing date <span class="text-danger text-lg">*</span> </label>
                                    <input type="date" name="clossing_date" value="{{ old('clossing_date', (isset($vacancy->clossing_date))? $vacancy->clossing_date : '') }}" class="form-control">
                                </div>
                            </div>
                        </div>
                        {{-- Row end --}}
                        <div class="row justify-content-center">
                            <div class="col-md">
                                <div class="form-group">
                                    <label for="description">Job Description <span class="text-danger text-lg">*</span> </label>
                                    <textarea name="description" id="" cols="30" rows="5" class="form-control editor2"
                                    placeholder="specify what the applicants is expected to do"
                                    >{{ old('description', (isset($vacancy->description))? $vacancy->description : '') }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-conteny-center">
                            <div class="col-md">
                                <div class="form-group">
                                    <label for="requirements">Education And Experience Requirements <span class="text-danger text-lg">*</span> </label>
                                    <textarea name="requirements" id="" cols="30" rows="5" class="form-control editor3"  placeholder="specify the prerequisite skills for this job">{{ old('requirements', (isset($vacancy->requirements))? $vacancy->requirements : '') }}</textarea>
                                </div>
                            </div>
                        </div>
                        {{-- Row end --}}
                        <div class="row justify-content-center">
                            <div class="col-md">
                                <div class="form-group">
                                    <label for="working_hours">Working Hours And Benefits <span class="text-danger text-lg">*</span> </label>
                                    <textarea cols="30"rows='5'  name="working_hours" class="form-control editor4"> {{ old('working_hours', (isset($vacancy->working_hours))? $vacancy->working_hours : '') }}
                                        </textarea>
                                </div>
                            </div>
                        </div>
                        {{-- Row end --}}
                        <div class="row justify-content-center">

                            <div class="col-md">
                                <div class="form-group">
                                    <label for="skills_and_qualifications">Skills And Qualifications Requirements <span class="text-danger text-lg">*</span> </label>
                                    <textarea name="skills_and_qualifications" id="" cols="10" rows="5" class="form-control editor5"  placeholder="specify the prerequisite skills for this job">{{ old('skills_and_qualifications', (isset($vacancy->skills_and_qualifications))? $vacancy->skills_and_qualifications : '') }}</textarea>
                                </div>
                            </div>
                        </div>
                        {{-- Row end --}}
                        <div class="row justify-cont-center">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="state_id">Vacancy Location <span class="text-danger text-lg">*</span></label>
                                    <select name="state_id" id="state_id" class="form-control">
                                        <option value="">select a state</option>
                                        @foreach ($states as $state)
                                        <option value="{{ $state->state_id }}"
                                                {{ old('state_id', ) == $state->state_id ? 'selected' : '' }}
                                                @if(isset($vacancy->state_id) && $vacancy->state_id == $state->state_id)
                                                {{ 'selected'}}
                                                @endif

                                                >{{ $state->state_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email">Application Eamil/URL  <span class="text-danger text-lg">*</span> </label>
                                            <input type="text" name="email" value="{{ old('email', (isset($vacancy->email))? $vacancy->email : '') }}" required class="form-control" placeholder="this where the applications will be sent to">
                                        </div>
                                    </div>
                                </div>

                                {{-- Rowend --}}
                                <div class="row justify-content-center">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="phone">Contact Phone (optional)</label>
                                            <input type="number" min="0" name="phone" value="{{ old('phone', (isset($vacancy->phone))? $vacancy->phone : '') }}" placeholder="enter your contact phone number" class="form-control">
                                        </div>
                                    </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="min_qualification">Minimun Qualification<span class="text-danger text-lg">*</span></label>
                                    <select name="min_qualification" id="min_qualification" class="form-control">
                                    <option value="">select  an option</option>
                                    @foreach ($qualifications as $qualification)
                                        <option value="{{ $qualification }}"
                                            {{ old('min_qualification', ) == $qualification ? 'selected' : '' }}
                                            @if(isset($vacancy->min_qualification) && $vacancy->min_qualification == $qualification)
                                            {{ 'selected'}}
                                            @endif

                                            >{{ $qualification }}</option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-md-6 mt-4">
                                <div class="form-group">
                                    <button class="form-control btn btn-default"> {{ (Request::is('vacancy/edit/*'))?'Update' : 'Post' }} Vacancy</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

