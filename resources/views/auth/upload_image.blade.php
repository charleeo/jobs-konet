@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header ">
                    <div class="col-md-6 text-center text-dark">Upload A Profile Photo</div>
                </div>

                <div class="card-body shadow-lg border border-dark">
                    <form action="{{ route('profile-store', [ $user->id])}}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="row justify-content-center">
                                <div class="col-md-12">
                                  <div class="form-group">
                                      <label for="profile_photo">Profile Photo</label>
                                      <input type="file" value="{{ old('profile_photo') }}" name="profile_photo" class="form-control">
                                  </div>
                                </div>
                            </div>

                        {{-- Row end --}}
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <button class="btn btn-dark" >Save Photo</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

