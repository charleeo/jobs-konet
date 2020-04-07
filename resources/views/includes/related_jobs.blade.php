<div class="row shadow-lg d-flex flex-wramp justify-content-center" >
        @foreach ($similarJobs as $similarJob)
        @php
            $explodedTitle = explode(' ', $similarJob->role_title) ;
            $implodedTitle = implode('-', $explodedTitle)
        @endphp
        <div class="col-md-4 pt-3 ">
            <div class="card  shadow-lg deccided-height  ">
                <div class="card-body shadow-lg text-center border border-dark">
                    <a href="{{ route ('vacancy.details', [$similarJob->employer_id, $similarJob->category_id,$implodedTitle ]) }}" >
                    <span class="text-info">
                        {{ $similarJob->role_title }}
                    </span>
                    <hr>
                    <small>
                        <p class="text-dark">
                            {{ substr($similarJob->summary,  0, 100)}}
                        </p>
                    </small>
                    </a>
                    <address> Location: {{$similarJob->state->state_name}} State</address>
                </div>
            </div>
        </div>
        @endforeach
</div>
