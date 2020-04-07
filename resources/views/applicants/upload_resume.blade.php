@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header ">
                    <div class="col-md-6 text-center text-success">Upload Resume</div>
                </div>

                <div class="card-body shadow-lg border border-dark">
                    <form action="{{ route('applicant.save-cv', [ $applicant->user_id])}}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="row justify-content-center">
                                <div class="col-md-12">
                                  <div class="form-group">
                                      <label for="resume">Profile Photo</label>
                                      <input type="file" value="{{ old('resume') }}" name="resume" class="form-control">
                                  </div>
                                </div>
                            </div>

                        {{-- Row end --}}
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <button class="btn btn-success" >Create Resume</button>
                                </div>
                            </div>
                        </div>
                    </form>

                      @php

                    // $file = 'files/resumes/name.pdf';
                    // $filename = 'files/resumes/name.pdf';
                    // header('Content-type: application/pdf');
                    // header('Content-Disposition: inline; filename="' . $filename . '"');
                    // header('Content-Transfer-Encoding: binary');
                    // // header('Content-Length: ' . filesize($file));
                    // header('Accept-Ranges: bytes');
                    // @readfile($file);

                      @endphp
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

