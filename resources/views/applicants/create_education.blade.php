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
                        <button class="btn btn-success ">
                        Add Education Information
                        </button>
                    </h5>
                </div>
                </div>
            </div>
            <div class="card-body">
                <form action=
                "{{((Request::is('applicants/editing-education/*')) ? route('applicant.education-update', [$education->education_id, $education->applicant_id]):  route('applicant.education-save', [$applicantInfo->applicant_id, $applicantInfo->user_id])) }}" method="POST">
                    @csrf
                    {{ ((Request::is('applicants/editing-education/*'))? method_field('PATCH') : "") }}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="institution">Institution | School Attended</label>
                                <input type="text" placeholder="school name" name="institution" class="form-control" value="{{ old('institution', (isset($education->institution))? $education->institution: '') }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="qualification">Qualification</label>
                            <select name="qualification" id="" class="form-control">
                                <option value="">please choose an option</option>
                                @foreach ($qualifications as $qualification)
                                <option value="{{ $qualification}}"

                                {{ old('qualification') == $qualification ? 'selected' : '' }}
                                @if(isset($education->qualification) && $education->qualification == $qualification)
                                {{ 'selected'}}
                                @endif

                                >{{ $qualification }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="department">Department</label>
                                <input type="text" placeholder="department name" class="form-control" name="department" value="{{ old('department', (isset($education->department))? $education->department: '') }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="start_month">Start Month</label>
                            <select name="start_month" id="" class="form-control">
                                <option value="">please choose an option</option>
                                @foreach($months as $month)
                                <option value="{{ $month}}"

                                {{ old('start_month') == $month ? 'selected' : '' }}
                                @if(isset($education->start_month) && $education->start_month == $month)
                                {{ 'selected'}}
                                @endif

                                >{{ $month }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="start_year">Start Year</label>
                            <select name="start_year" id="" class="form-control">
                                <option value="">please choose an option</option>
                                @for($i = 1990; $i <= date('Y'); $i++)
                                <option value="{{ $i}}"

                                {{ old('start_year') == $i ? 'selected' : '' }}
                                @if(isset($education->start_year) && $education->start_year == $i)
                                {{ 'selected'}}
                                @endif

                                >{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="still_studying">Still Studying</label> &nbsp;
                                <input type="checkbox" value="yes" id="check-if-checked"

                                {{ old('still_studying') == 'yes' ? 'checked' : '' }}
                                @if(isset($education->still_studying) && $education->still_studying == 'yes')
                                {{ 'checked'}}
                                @endif

                                name="still_studying" class="text text-lg">
                            </div>
                        </div>
                        <div class="col-md-3 col-md-3 chech-current-working-status">
                            <label for="end_month">End Month</label>
                            <select name="end_month" id="" class="form-control end-period">
                                <option value="">please choose an option</option>
                                @foreach($months as $month)
                                <option value="{{ $month}}"

                                {{ old('end_month') == $month ? 'selected' : '' }}
                                @if(isset($education->end_month) && $education->end_month == $month)
                                {{ 'selected'}}
                                @endif

                                >{{ $month }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 col-md-3 chech-current-working-status">
                            <label for="end_year">End Year</label>
                            <select name="end_year" id="" class="form-control end-period">
                                <option value="">please choose an option</option>
                                @for($i = 1990; $i <= date('Y'); $i++)
                                <option value="{{ $i}}"

                                {{ old('end_year') == $i ? 'selected' : '' }}
                                @if(isset($education->end_year) && $education->end_year == $i)
                                {{ 'selected'}}
                                @endif


                                >{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <div class="form-group">
                                <textarea name="brief_description" placeholder="brief description" class="form-control" id="" cols="30" rows="6" >{{ old('brief_description', (isset($education->brief_description))? $education->brief_description: '') }}</textarea>
                                <label for="brief_description">A Brief Description (optional)</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class= 'form-group'>
                                <button class="btn btn-dark form-control submit-data ">Cancel</button>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <button class="btn btn-success form-control " >Save</button>
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
