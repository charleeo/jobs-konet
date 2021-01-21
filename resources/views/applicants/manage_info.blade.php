@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center">
        <div class="col-md">
            <div class="card p-5 border-0">
                
                        <div id="accordion">
                        @include('applicants.create_personal_data')

                        @if(!empty($applicantInfo->user_id))
                            @include('applicants.view_personal_data')
                        </div>
                        <div class="card">
                            <div class="card-body bg-white">
                                <div class="row d-flex justify-content-center">
                                    <div class="col-md-6 offset-md-3 d-flex justify-content-center ">
                                        <a href="{{ route ('delete', [$applicantInfo->applicant_id]) }}"
                                            onclick='return confirm("Are you sure you want to delete ?  This action will remove all your records from the system, the only information that will be left are your login credentials. Click Ok to delete or cancel to stop the action")' class=" btn btn-danger">
                                            <i class="fa fa-trash fa-2x"></i> Delete Profile Information
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
            </div>
        </div>
    </div>
</div>
@endsection
