@extends('layouts.app')

@section('content')

<section class="justify-content-center pl-4">
    <form action="{{route('search-applicants')}}" method="POST">
        @csrf
        <div class="row justify-content-center">
            <div class="col-sm-6">
                <div class="form-group">
                    <input type="text" name="search_name" class="form-control" placeholder="you can type proffesional title for a quick search">
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <select name="state_id"  class="form-control">
                        <option value="">please choose an option</option>
                        @foreach ($states as $state)
                            <option value="{{$state->state_id}}">{{$state->state_name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    <button class="btn">
                        <i class="fas fa-search fa-2x text-info"> search </i>
                    </button>
                </div>
            </div>
        </div>
    </form>
</section>

<section class="pl-4 bg-white pt-4" id="employee">
    @if(request()->is('applicants/applicant-search'))
        <button class="button">
            <a href="{{route('applicant.all')}}">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </button>
    @endif
    <div class="row  d-flex flex-wramp justify-content-center " >
    @foreach ($applicants as $applicant)

    <div class="col-md-5 mb-3  ml-2" >
        <div class="align-self-center ">
            <div class="row">
                {{-- Image and Title --}}

                @php
                $path = asset('images/profile_pics/default-image');
                
                if ($applicant->user->profile_photo !== 'noimage.png'){
                    $path = asset('images/profile_pics');
                }
                @endphp
                <div class="col-sm-5  shadow py-2 pb-3 bg-white">
                    <h6 class=" justify-content-center">
                        <img src="{{$path.'/'.$applicant->user->profile_photo}}" alt="profile image" class="rounded-circle" width="100" height="100">
                    </h6>
                    <hr>
                    <h6>{{$applicant->first_name}}
                        {{$applicant->other_names}}
                    </h6>
                    <h6>
                        Professional Title: {{$applicant->designation}}
                    </h6>
                    <button class="btn btn-link" >
                    <a href="{{route('applicant.details', [$applicant->applicant_id])}}" > <i class="fa fa-eye  text-info"></i> detail
                    </a>
                    </button>
                </div>
                {{-- Skills --}}
                <div class="col-sm-7 shadow py-2 pb-3">
                    <div class="row">
                        <div class="col ">
                            <h6 class="text-center">Skills:</h6> <hr/>
                            <ol class="d-flex flex-wrap pl-4" id="skills">
                                @foreach (explode(',', $applicant->skills) as $skill)
                                    <li class="ml-3">{{strtolower($skill)}}</li> &nbsp;&nbsp;
                                @endforeach
                            </ol>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        @endforeach
        <hr/>
    </div>
</section>
    @endsection
