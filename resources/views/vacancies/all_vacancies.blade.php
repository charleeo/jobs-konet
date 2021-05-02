@extends('layouts.app')

@section('content')
{{-- search form --}}
<form action="{{route('search-vacancies')}}" method="POST">
    @csrf
    <div class="row justify-content-center px-5">
        <div class="col-md-4 col-sm-6 ">
            <div class="form-group">
                <input type="text" name="search_name" class="form-control" placeholder="type here to search by your prefrence">
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
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
                    <i class="fas fa-search fa-2x text-dark"> search </i>
                </button>
            </div>
        </div>
    </div>
</form>


<div class="row  px-3 d-flex flex-wramp px-5" >
    @foreach ($vacancies as $vacancy)
    @php
        $explodedTitle = explode(' ', $vacancy->role_title) ;
        $implodedTitle = implode('-', $explodedTitle)
    @endphp
    <div class="col-md-4 p-3 ">
        <div class="card   deccided-height  ">
            <div class="card-body shadow   border-dark">
                <a href="{{ route ('vacancy.details', [$vacancy->employer_id, $vacancy->category_id,$implodedTitle ]) }}" class="text-dark"><span class="text-info">{{ $vacancy->role_title }}</span>
                <hr>
                <small>

                       {!! html_entity_decode(substr($vacancy->summary,  0, 100))!!}

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
