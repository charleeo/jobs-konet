@php
    $range = 49000;
@endphp
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md">
            <div class="card">
                <div class="card-header">{{Auth::user()->name}} Profile Page</div>
                    <div class="card">
                    <div class="card-header" id="headingThree">
                        <div class="row justify-content-center">
                            <div class="col-md-6 offset-md-3">
                                <h5 class="mb-0">
                                    <button class="btn  collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    {{ ((Request::is('applicants/editing-experience/*'))? " Edit" : " Add") }} Experience
                                    </button>
                                </h5>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                    <form
                    action="{{((Request::is('applicants/editing-experience/*')) ? route('applicant.experience-update', [$experienceInfo->experience_id, $experienceInfo->applicant_id]): route('applicant.experience-save', [$applicantInfo->applicant_id, $applicantInfo->user_id])) }}"
                    method="POST">
                        @csrf
                        {{ ((Request::is('applicants/editing-experience/*'))? method_field('PATCH') : "") }}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="employer_name">Employer Name</label>
                                    <input type="text" name="employer_name" placeholder="the company's name" class="form-control" value="{{ old('employer_name', isset(($experienceInfo->employer_name))? $experienceInfo->employer_name :'')}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="job_title">Job  Title</label>
                                    <input type="text" name="job_title" placeholder="the company's name" class="form-control" value="{{old('job_title', isset(($experienceInfo->job_title))? $experienceInfo->job_title:"")}}">
                                </div>
                            </div>
                        </div>
                        {{-- Row end --}}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="state_id">State Or Location</label>
                                    <select  name="state_id"  class="form-control">
                                        <option value="">select</option>
                                        @foreach ($states as $state)
                                        <option value="{{ $state->state_id }}"
                                        {{ old('state_id') == $state->state_id ? 'selected' : '' }}
                                        @if(isset($experienceInfo->state_id) && $experienceInfo->state_id == $state->state_id)
                                        {{ 'selected'}}
                                        @endif
                                        >{{ $state->state_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="salary">Salary  Range</label>
                                    <select  name="salary"  class="form-control">
                                        <option value="">select</option>
                                        @for($i = 50000; $i <= 10000000; $i+= 50000)
                                        <option value='{{ $i .('-'). ($i + $range) }}'

                                        {{ old('salary') == $i .('-'). ($i + $range) ? 'selected' : '' }}
                                        @if(isset($experienceInfo->salary) && $experienceInfo->salary == $i .('-'). ($i + $range))
                                        {{ 'selected'}}
                                        @endif

                                        > {{ $i .('-'). ($i + $range) }} </option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </div>

                        {{-- Row end --}}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="category_id">Industry Category</label>
                                    <select  name="category_id"  class="form-control">
                                        <option value="">select</option>
                                        @foreach ($categories as $category)
                                        <option value="{{ $category->category_id }}"
                                        {{ old('category_id') == $category->category_id ? 'selected' : '' }}
                                        @if(isset($experienceInfo->category_id) && $experienceInfo->category_id == $category->category_id)
                                        {{ 'selected'}}
                                        @endif
                                        >{{ $category->category_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="engagement_type">Engagement Type</label>
                                    <select  name="engagement_type"  class="form-control">
                                        <option value="">select</option>
                                        @foreach($engagements as $engagement)
                                        <option value='{{ $engagement }}'

                                        {{ old('engagement_type') == $engagement ? 'selected' : '' }}
                                        @if(isset($experienceInfo->engagement_type) && $experienceInfo->engagement_type == $engagement)
                                        {{ 'selected'}}
                                        @endif

                                        > {{ $engagement }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        {{-- Row end --}}
                        <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="department">Department</label>
                                        <input type="text" placeholder="department name"  name="department" class="form-control"value="{{old('department', isset(($experienceInfo->department))?$experienceInfo->department:"")}}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="start_month">Start Month</label>
                                        <select name="start_month" id="" class="form-control">
                                            <option value="">please choose an option</option>
                                            @foreach($months as  $month)
                                            <option value="{{ $month}}"

                                            {{ old('start_month') == $month ? 'selected' : '' }}
                                            @if(isset($experienceInfo->start_month) && $experienceInfo->start_month == $month)
                                            {{ 'selected'}}
                                            @endif

                                            >{{ $month }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="start_year">Start Year</label>
                                        <select name="start_year" id="" class="form-control">
                                            <option value="">please choose an option</option>
                                            @for($i = 1990; $i <= date('Y'); $i++)
                                            <option value="{{ $i}}"

                                            {{ old('start_year') == $i ? 'selected' : '' }}
                                            @if(isset($experienceInfo->start_year) && $experienceInfo->start_year == $i)
                                            {{ 'selected'}}
                                            @endif

                                            >{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="still_working_there">Still Working Here</label> &nbsp;
                                        <input type="checkbox"  name="still_working_there" id="check-if-checked" value="yes" {{ (old('still_working_there') == 'yes')? 'checked': ''}}
                                        {{((isset($experienceInfo->still_working_there) && $experienceInfo->still_working_there =='yes' )? 'checked': '')}}
                                        class="text text-lg">
                                    </div>
                                </div>
                                <div class="col-md-3 chech-current-working-status">
                                    <div class="form-group">
                                        <label for="end_month">End Month</label>
                                        <select name="end_month" id="" class="form-control end-period">
                                            <option value="">please choose an option</option>
                                            @foreach($months as  $month)
                                            <option value="{{ $month}}"

                                            {{ old('end_month') == $month ? 'selected' : '' }}
                                            @if(isset($experienceInfo->end_month) && $experienceInfo->end_month == $month)
                                            {{ 'selected'}}
                                            @endif

                                            >{{ $month }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3 chech-current-working-status">
                                    <div class="form-group">
                                        <label for="end_year">End Year</label>
                                        <select name="end_year" id="" class="form-control end-period">
                                            <option value="">please choose an option</option>
                                            @for($i = 1990; $i <= date('Y'); $i++)
                                            <option value="{{ $i}}"

                                            {{ old('end_year') == $i ? 'selected' : '' }}
                                            @if(isset($experienceInfo->end_year) && $experienceInfo->end_year == $i)
                                            {{ 'selected'}}
                                            @endif

                                            >{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                            </div>
                            {{-- Row end --}}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="expereiece_level">Work Experience Level</label>
                                        <select  name="experience_level"  class="form-control">
                                            <option value="">select</option>
                                            @foreach ($experienceLevel as $experience)
                                            <option value="{{ $experience }}"

                                            {{ old('experience_level') == $experience ? 'selected' : '' }}
                                            @if(isset($experienceInfo->experience_level) && $experienceInfo->experience_level == $experience)
                                            {{ 'selected'}}
                                            @endif

                                            >{{ $experience }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="work_description">Work Description</label>
                                        <textarea name="work_description" placeholder="give a brief description of your experience in this role" class="form-control editor"  cols="30" rows="6"> {{ old('work_description', isset(($experienceInfo->work_description))? $experienceInfo->work_description:"")}}   </textarea>
                                    </div>
                                </div>
                            </div>

                            {{-- Row end --}}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <a href="{{route('applicant.experience-all',[$applicantInfo->applicant_id, $applicantInfo->user_id]) }}" type="button" class="btn btn-dark text-center form-control">{{ ((Request::is('applicants/editing-experience/*'))? " Go Back" : " Cancel") }}</a>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-dark text-center form-control submit-data">{{ ((Request::is('applicants/editing-experience/*'))? "Update" : " Save") }}</button>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="applicant_id" value="{{ $applicantInfo->applicant_id }}">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

