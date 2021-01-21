@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-8">
            <div class="panel">
                {{-- @component('components.who')   @endcomponent --}}

            </div>
        </div>
    </div>
    <div class="row justify-content-center p-5">
        <div class="col-md">
            @if(count($vacancies) > 0)
            <table class="table table-striped">
                <thead>
                    <th>S\N</th>
                    <th>Title</th>
                    <th>Expiration  Date</th>
                    <th>Details</th>
                    <th class="text-info"><i class="fas fa-eraser"></i>  Edit</th>
                    <th class="text-danger"> <i class="fas fa-trash"></i> Delete</th>
                </thead>
                <tbody>

                    @foreach ($vacancies as $key => $vacancy)
                    @php
                    $explodedTitle = explode(' ', $vacancy->role_title);
                    $implodedTitle = implode('-', $explodedTitle)
                    @endphp
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td> {{ $vacancy->role_title}} </td>
                        <td>{{ $vacancy->clossing_date}}</td>
                        <td>
                            <a href="{{ route ('vacancy-employer.details', [$vacancy->employer_id, $implodedTitle ]) }}">View Details
                            </a>
                        </td>
                        <td>
                            <a href="{{ route ('employer.edit', [$vacancy->employer_id]) }}" class="text-info"> Edit
                            </a>
                        </td>
                        <td>
                            <a href="{{ route ('employer.delete-vacancy', [$vacancy->employer_id]) }}"
                                    onclick='return confirm("Are you sure you want to delete ?")' class="text-danger"> Delete
                            </a>
                        </td>
                    </tr>
                        @endforeach
                </tbody>
            </table>
            @else <p class="text-center text-dark">
                You have no active vacancy
            </p>
            @endif
        </div>
    </div>
@endsection
