
@extends('layouts.app')

@section('content')
<div class="container">
   <div class="card bg-white">
       <div class="card-body">
        <section class="pl-4">
            {{-- @foreach($experiences as $key=> $experience)
            <h3 class="text-center">Work Experience {{ (count($experiences) > 1)? ($key+1):"" }} </h3> --}}
            <div class="row justify-content-content  shadow-lg bg-white p-4">
                <div class="col-md-6 border">
                    <h4>Detailed Information</h4>
                    <h6>Role Title: {{$experience->job_title}}</h6>
                    <small>
                        <p> <b>Engagemnet Time: &nbsp;</b> {{$experience->start_month}} Of {{$experience->start_year}} &nbsp; --- &nbsp;
                            @if($experience->still_working_there == 'no')
                        {{$experience->end_month}}  {{$experience->end_year}}</p>
                        @else
                        Date
                        @endif
                    </small>
                    <h6>Employer : {{$experience->employer_name}}</h6>
                    <small>
                        <hr>
                        Department: {{$experience->department}} <br/>
                        Engagemnet Type: {{$experience->engagement_type}} <br/>
                        Industry: {{$experience->category->category_name}} <br/>
                    </small>
                </div>
                <div class="col-md-6 border">
                    <h4>Experience Description</h4>
                    <p>{!! $experience->work_description!!}</p>
                </div>
            </div>
            {{-- <button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModal">
                    Reach Out
            </button> --}}
        </section>
       </div>
   </div>
@endsection

