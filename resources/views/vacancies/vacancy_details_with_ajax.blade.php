    @php
        $re = '/(?<!e.g)(?<=[.!?]|[.!?][\'"])\s+(?=\S)/';
        // $re2 = '/(?<=[.!?])\s+(?=\S)/';
        $paragraphs = preg_split($re, $vacancy->description, -1);
        $requirements = preg_split($re, $vacancy->requirements, -1);
        $descriptions = preg_split($re, $vacancy->description, -1);
        $skills_and_qualifications = explode('.', $vacancy->skills_and_qualifications, -1);
        $working_hours = preg_split($re, $vacancy->working_hours, -1);
    @endphp

<div class="row px-2">
    <div class="col-md-5 card border-0 shadow mr-2">
        <div class="card-body">
            <h2>Industry Category</h2>
            <h2 >
                Jobs in
                <strong>
                        {{ $vacancy->category->category_name }}
                </strong>
            </h2> <hr>
            <h2 class="">Vacancy Title</h2>
            <h3 class="text-dark">{{ $vacancy->role_title }}</h3>
            <p>By: <strong>{{ $vacancy->user->name }}</strong></p>
            <p>Category:  {{ $vacancy->category->category_name }} </p>
            <span>State: {{ $vacancy->state->state_name }}</span> | <span>{{$vacancy->engagement}}</span>
        </div>
    </div><hr>
    {{-- Working hours and benefits --}}
    <div class="col-md-6 card border-0 shadow">
        <div class="card-body">
            <h4>Working Hours And Benefits</h4>
            <ul>
                @foreach ($working_hours as $hour)
                    <li> {!! html_entity_decode($hour) !!} </li>
                @endforeach
            </ul>
        </div>
    </div>
    </div>
</div>
<hr>

<div class="row  mb-2 px-2">
    <div class="col-md-5 mr-2 card border-0 shadow">
        <div class="card-body">
            {{-- Summary --}}
            <h4 class="pl-3">Job Summary</h4>
            <p> {!! html_entity_decode($vacancy->summary) !!} </p>
            <hr>
            <ul>
                <li>Experience Length: <strong>{{ $vacancy->min_experience }} </strong></li>
                <li>Experience Level: <strong> {{ $vacancy->experience_level }}</strong> </li>
                <li>Minimum Qulification: <strong> {{ $vacancy->min_qualification }} </strong> </li>
                <li>Salary: <strong>{{$vacancy->salary}}</strong></li>
                <li>Dead-Line: <strong>{{date_format(date_create($vacancy->clossing_date), '\O\n l jS \of\ F Y')}}</strong></li>
            </ul>
        </div>
    </div> <hr>

    
    {{-- Description --}}
    <div class="col-md-6 card border-0 shadow">
        <div class="card-body">
            <h4>Job Description</h4>
            <ul>
                @foreach ($descriptions as $description)
                <li>{!! html_entity_decode($description) !!}</li>
                @endforeach
            </ul>
        </div>
    </div>
</div>



    {{-- Skills Sets --}}
<div class="row mb-2 px-2 ">
    <div class="col-md-5 mr-2 card border-0  shadow">
        <div class="card-body">
            <h4>Skills And Qulifications</h4>
            <ul>
                @foreach ($skills_and_qualifications as $skills)
                    <li> {!! html_entity_decode($skills ) !!} .</li>
                @endforeach
            </ul>
        </div>
    </div> <hr>
    {{-- Requirements --}}
    <div class="col-md-6 card border-0 shadow">
        <div class="card-body">
            <h4> Education And Experience Requirements</h4>
            <ul>
                @foreach ($requirements as $required)
                <li>{!! html_entity_decode($required) !!}</li>
                @endforeach
            </ul>
        </div>
    </div>
</div>

{{-- Apply button --}}
<div class="row justify-content-center">
    <div class="col-6">
        <button class="btn-readmore">Apply</button>
    </div>
</div>
