@php
    $range = 49000;
@endphp
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md">
        <div class="card">
        <div class="card-header text-dark text-center"> <h3>Add Skill</h3></div>
                <div class="card-body ">
                    <form action="{{ route('applicant.save-skills', $applicant->user_id) }}" method="POST">
                        @csrf
                        <h2 class="text-center">Note: separate each skill set with a comma (<b>,</b>) </h2>
                        <p>Note: only ten(10) skill sets can be supplied. if you wish to replace an existing skill set with a new one when you have already supplied above ten(10), just enter the new skill and the old one from ten(10) and above will be removed.</p>
                        <div class="row">
                            <div class="col-md-9">
                                <div class="form-group">
                                    <label for="skills">Add Skills</label>
                                    <input type="text"  name="skills" class="form-control" value="{{ old('skills', (isset($education->skills))? $education->skills: '') }}" placeholder="enter skills set like: Music Writing, Contents Developement, Web Design etc">
                                </div>
                            </div>
                            <div class="col-md-3 pt-1">
                                <div class="form-group">
                                    <label for="submit"></label>
                                    <button class="btn btn-dark form-control " >Save</button>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="applicant_id" value="{{ $applicantInfo->applicant_id }}">
                    </form>
                    <div class="row d-flex pl-5">
                        @if (isset($skills))
                        <ul>
                            @foreach ($skills as $key => $skill)
                            <li>
                               {{$key +1 }}. <strong> {!! strip_tags($skill)!!} &nbsp; &nbsp; </strong>
                            </li>
                            @endforeach
                        </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
