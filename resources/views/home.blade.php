@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                        <h1>
                                This is Your Dashboard
                            </h1>
                            <p>Features comming soon</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

{{-- {{ (strpos(Route::currentRouteName(), 'admin.cities') == 0) ? 'active' : '' }} --}}
