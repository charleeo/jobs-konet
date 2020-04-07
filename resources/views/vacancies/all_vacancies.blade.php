@extends('layouts.app')

@section('content')
{{-- search form --}}
<form action="{{route('search-vacancies')}}" method="POST">
    @csrf
    <div class="row justify-content-center">
        <div class="col-sm-6">
            <div class="form-group">
                <input type="text" name="search_name" class="form-control" placeholder="type here to search by your prefrence">
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


<div class="row shadow-lg d-flex flex-wramp" >
    @foreach ($vacancies as $vacancy)
    @php
        $explodedTitle = explode(' ', $vacancy->role_title) ;
        $implodedTitle = implode('-', $explodedTitle)
    @endphp
    <div class="col-md-3 pt-3 ">
        <div class="card  shadow-lg deccided-height  ">
            <div class="card-body shadow-lg border border-dark">
                <a href="{{ route ('vacancy.details', [$vacancy->employer_id, $vacancy->category_id,$implodedTitle ]) }}" class="text-dark"><span class="text-info">{{ $vacancy->role_title }}</span>
                <hr>
                <small>
                    <p>
                        {{ substr($vacancy->summary,  0, 100)}}
                    </p>
                </small>
                </a>
                <address class="text-info"> Location: {{$vacancy->state->state_name}} State</address>
            </div>
        </div>
        <hr>
    </div>
    @endforeach
</div>
@endsection
