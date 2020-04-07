@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header ">
                    <div class="col-md-6 text-center text-success">Update  Password</div>
                </div>

                <div class="card-body shadow-lg border border-dark">
                    <form action="{{ route('users.update.passwrod')}}" method="POST">
                        {{ csrf_field() }}
                        {{  method_field('PATCH')  }}
                        <div class="row justify-content-center">
                                <div class="col-md-12">
                                  <div class="form-group">
                                      <label for="old_password">Old Password</label>
                                      <input type="password" name="old_password" class="form-control">
                                  </div>
                                </div>
                            </div>

                        {{-- Row end --}}
                        <div class="row justify-content-center">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="password">New Password</label>
                                    <input type="password"name='password' class="form-control">
                                </div>
                            </div>
                        </div>
                        {{-- Row end --}}
                        <div class="row justify-content-center">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="c-password">Re-type Password</label>
                                    <input type="password"name='c-password' class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <button class="btn btn-success" >Save Changes</button>
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

