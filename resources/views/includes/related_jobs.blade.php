@if (count($similarJobs) >0)

<h3>Related Jobs</h3> <br>
<div class="row  justify-content-center" >
        @foreach ($similarJobs as $similarJob)
        @php
            $explodedTitle = explode(' ', $similarJob->role_title) ;
            $implodedTitle = implode('-', $explodedTitle)
        @endphp
        <div class="col-md-6 py-3 ">
            <div class="card ">
                <div class="card-body shadow text-center border border-dark">
                    <a href="{{ route ('vacancy.details', [$similarJob->employer_id, $similarJob->category_id,$implodedTitle ]) }}" >
                    <span class="text-info">
                        {{ $similarJob->role_title }}
                    </span>
                    <hr>
                    <small>
                        <p class="text-dark">
                            {!! substr($similarJob->summary,  0, 100)!!}
                        </p>
                    </small>
                    </a>
                    <address> Location: {{$similarJob->state->state_name}} State</address>
                </div>
            </div>
        </div>
        @endforeach
</div>
@endif
