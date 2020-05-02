@php
    $range = 49000;
@endphp
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
    <div class="col-md">
        <div class="card">
        <div class="card-header text-info text-center"> <h3>Create Alert Preference</h3></div>
            <div class="card-body">
                <form action="{{ route('save.alert', $applicant->user_id) }}" method="POST">
                    @csrf
                    <h6 class="text-center">Note: Enter and save only one alert preference at a time. Do not enter comma separated string(<b>,</b>) </h6> <br>
                    <p class="text-center">
                        Note: Create Alert Preference enables us to determine your job search preference and the alert category to be sent to you. <br>
                        You can create as many alert preference as possible
                    </p>
                    <div class="row">
                        <div class="col-md-9">
                            <div class="form-group">
                                <label for="alert_type">Add Alert Type</label>
                                <input type="text"  name="alert_type" id="alert-type" class="form-control" value="{{ old('alert_type') }}" placeholder="enter the job preference you wish to receive alert for eg front desk officer, web developer etc">
                            </div>
                        </div>
                        <div class="col-md-3 pt-1">
                            <div class="form-group">
                                <label for="submit"></label>
                                <button class="btn btn-info form-control " >Save</button>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="applicant_id" value="{{ $applicantInfo->applicant_id }}">
                </form>
                <div class="row d-flex pl-4">
                    <ol>
                        @foreach (explode(',',$applicant->alert_preference) as $key => $alert)
                        <li>
                             <strong> {{strtoupper($alert)}} &nbsp; &nbsp; </strong>
                        </li>
                        @endforeach
                    </ol>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
