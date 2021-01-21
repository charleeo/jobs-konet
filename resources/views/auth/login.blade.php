@extends('layouts.app')

@php
    $title ="Login Page";
@endphp
@section('content')
<div class="container p-3">
    <div class="row justify-content-center">
        <div class="col-md-6 offset-md-3">
            <div class="card p-4">
                <div class="card-header">{{ __('Login Form') }}</div>
                <div class="card-body">
                    @include('includes.login')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
