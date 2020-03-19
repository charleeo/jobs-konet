@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header ">
                    <div class="row">
                        <div class="col-md-6 text-center text-success">Vacancy Creation Form</div><hr>
                        <div class="col-md-6 text-center">Note: All fields with <span class="text-danger">*</span> are required</div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row justify-content-center">
                            @if ($errors->any())
                            <div class="col-md-8 offset-md-2 alert-danger">
                                  @foreach ($errors->all() as $error)
                                    <span>{{ $error }}</span>
                                    @break;
                                  @endforeach
                            </div><br />
                          @endif
                    </div>
                    <form action="{{ route('employer.store') }}" method="POST">
                        @csrf
                        <input type="hidden" value="{{ Auth::user()->id }}">
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="role_title">Role Title <span class="text-danger text-lg">*</span> </label>
                                    <input type="text" class="form-control" name="role_title" required id="role_title" placeholder="You can specify more than one role" value="{{ old('role_title') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="salary"> &#8358; Salary (optional)</label>
                                    <input type="text" name="salary" class="form-control" value="{{ old('salary') }}">
                                </div>
                            </div>
                        </div>

                        {{-- Row end --}}
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="states">Vacancy States <span class="text-danger text-lg">*</span></label>
                                    <select name="state_id" id="state_id" class="form-control">
                                        <option value="">select a state</option>
                                        @foreach ($states as $state)
                                            <option value="{{ $state->state_id }}"
                                                {{ old('state_id') == $state->state_id ? 'selected' : '' }}
                                                >{{ $state->state_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="address">Detailed Address <span class="text-danger text-lg">*</span> </label>
                                    <input type="text" value="{{ old('address') }}" name="address" class="form-control">
                                </div>
                            </div>
                        </div>
                        {{-- Row end --}}
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Application Eamil Address <span class="text-danger text-lg">*</span> </label>
                                    <input type="email" name="email" value="{{ old('email') }}" required class="form-control" placeholder="this where the applications will be sent to">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone">Contact Phone (optional)</label>
                                    <input type="number" min="0" name="phone" value="{{ old('phone') }}" placeholder="enter your contact phone number" class="form-control">
                                </div>
                            </div>
                        </div>
                        {{-- Row end --}}
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="min_experience">Min Experience Rquired <span class="text-danger text-lg">*</span> </label>
                                    <input type="number" name="min_experience" value="{{ old('min_experience') }}" placeholder="numbers only: specify the min experience length" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="clossing_date">Application clossing date <span class="text-danger text-lg">*</span> </label>
                                    <input type="date" name="clossing_date" value="{{ old('clossing_date') }}" class="form-control">
                                </div>
                            </div>
                        </div>
                        {{-- Row end --}}
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="description">Role Description <span class="text-danger text-lg">*</span> </label>
                                    <textarea name="description" id="" cols="30" rows="10" class="form-control"  placeholder="specify what the applicants is expected to do">{{ old('description') }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="requirements">Role Requirements <span class="text-danger text-lg">*</span> </label>
                                    <textarea name="requirements" id="" cols="30" rows="10" class="form-control"  placeholder="specify the prerequisite skills for this job">{{ old('requirements') }}</textarea>
                                </div>
                            </div>
                        </div>
                        {{-- Row end --}}
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <button class="form-control btn btn-success">Create Vacancy</button>
                                </div>
                            </div>
                        </div>
                        {{-- Row end --}}
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

