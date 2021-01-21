@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">SWITCH USAGE </div>

                <div class="card-body">
                   <div class="row">
                       <div class="col-md">
                           <h3 class="text-center">
                               Please select usage category from the options below.
                           </h3>

                           <h3 id="switch_user_message_tage"></h3>
                           <hr>
                           <form  id="switch_user_form">
                            @csrf
                            @method('PATCH')

                            <label for="user_type">NOTE: You can either choose to act as an employee or an employer. Any option selected will give you its own features. You can always change the options from the settings tab</label>

                            <div class="form-group">
                                <select name="user_type" id="switch_user" class="form-control">
                                    <option value="">select an option</option>
                                    <option value="{{('employer')}}">Employer</option>
                                    <option value="{{('applicant')}}">Applicant</option>
                                </select>
                            </div>
                            </form>
                       </div>
                   </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
