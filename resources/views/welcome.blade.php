@extends('layouts.app')

@section('content')

  <!-- Banner -->
  <header>
    <div id="banner">
      <div id="header">
          <h1>FINGER TIP CONNECT</h1>
          <h3>Have Access To Jobs And Top Tallents</h3>
      </div>
      <section id="about-u">
            <div id="mission">
                <div>OUR</div>
                <div>MISSION</div>
            </div>
            <div class="type-text-div">
                <span class="type-text"></span> <span class="cursor">&nbsp;</span>
            </div>
        </section >
    </div>
  </header>

  <!-- Main -->
  <main>
    <section id="home-section">
        <div class="card-description">
            <div class="row justify-content-center">
                <div class="col-md-6">

                    <p>
                        Everyone must be engaged and every project must be delivered
                    </p>
                </div>
            </div>

        </div>
            <a href="{{route('about')}}" class="btn-readmore">Read More</a>
    </section>


    <section id="section-source" class="p-5">
        <h2 class="section-heading">TESTIMONIALS</h2>
        <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="row justify-content-center">
                        {{-- <div class="col-md-4"><img src="{{asset('')}}" alt="Testifier"></div> --}}
                        <div class="col-md-6">
                            <div class="card shadow">
                                <div class="card-body">
                                    <p class="text-dark testimonies">
                                        I am so impressed with the type of job post a see here; to are verified and updated. No expired job is advertised and every job advert is always up to standard. Keep up the good work guys
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="row justify-content-center">
                        {{-- <div class="col-md-4"><img src="" alt="Testifier"></div> --}}
                        <div class="col-md-6">
                            <div class="card shadow">
                                <div class="card-body">
                                    <p class="text-dark testimonies">
                                      All appreciation go to the created of this platform for making such a simple but efficient solution that helps connect HR Manager to potential employees
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <hr>
    <section id="jobs_and_tallents" class="p-5">
        <div class="row justify-content-center">
            <div class="col-md-5 p-3">
                <p class="text-dark"> <b>
                    For all your job searching and hunting, we are here to take that burden off your shoulder. Simply click on browse jobs button to a list of available jobs that you can easily apply for
                </b>
                </p> <br> <hr>
                <button class="btn-readmore" id="browse-jobs">Browse Jobs </button>
                <a href="{{route('all-vacancies')}}" class="btn btn-dark text-light" id="more-jobs">MORE JOBS HERE</a>
            </div>
            <div class="col-md-5 border-left p-3">
                <p><b>
                  If you have ever wondered how you can have access to top skills for that your project, then, wonder no more as we have colated a lsit of very talented individuals for all your projects needs.
                </b></p>
                <p><b>Simply click on browse skills button to get started</b></p> <hr>
                <button class="btn-readmore" id="browse-talents">Browse Skills</button>
                <a href="{{route('applicant.all')}}" class=" pl-2 pr-2 btn btn-dark" id="more-skills"> MORE SKILLS HERE</a>
            </div>
        </div>
    </section>
   <section id="jobs" class="pl-2 pt-2">
       {{-- <div class="row"> --}}
           @if(!empty($vacancies))

        <div class="card jobs-lists" id="jobs-lists">
            <h3 class="text-center">Available Jobs</h3>
            @foreach ($vacancies as $vacancy)
            @php

            $explodedTitle = explode(' ', $vacancy->role_title) ;
            $implodedTitle = implode('-', $explodedTitle)
            @endphp
            <div class="card-body">
                <h2>Industry:
                    <strong>
                        {{ $vacancy->category->category_name }}
                    </strong>
                </h2>
                    <hr>
                <h3 class="text-dark">Title: {{ $vacancy->role_title }}</h3>
                <p>By: <strong>{{ $vacancy->user->name }}</strong></p>
                <span>State: {{ $vacancy->state->state_name }}</span> | <span>{{$vacancy->engagement}}</span> <br>
                <button id="{{$vacancy->employer_id}}" class=" details btn-readmore " ><i class="fas fa-eye"></i> Deatils</button>
            </div>
            @endforeach


        </div>
        @endif
             <div id="loader-display"></div>
              <div  id="vacancy-details" class="vacancy">
              </div>
   </section>

   <hr>

   <section id="skills" class="pt-5 px-3 border-0">
    {{-- <div class="row"> --}}
        @if(!empty($applicantsHomeView))

        <div class="card skills-lists" id="skills-lists">
            <h3 class=" px-5 text-center">Available Skills</h3>
            <div class="card-body mb-3 ml-2" >
                <div class="align-self-center">
                    <div class="row  justify-content-center" data-aos="fade-right">
                        @foreach ($applicantsHomeView as $applicant)
                        {{-- Image and Title --}}
                        <div class="col-md-6  shadow py-2 pb-3">
                            <h6 class=" justify-content-center">
                                @php
                                $path = asset('images/profile_pics/default-image');

                                if ($applicant->user->profile_photo !== 'noimage.png'){
                                    $path = asset('images/profile_pics');
                                }
                                @endphp
                                <img src="{{$path .'/'.$applicant->user->profile_photo}}" alt="profile image" class="rounded-circle" width="100" height="100">
                            </h6>
                            <hr>
                            <h6>{{$applicant->first_name}}
                                {{$applicant->other_names}}
                            </h6>
                            <h6>
                                Professional Title: {{$applicant->designation}}
                            </h6>
                              <hr>
                            <h6 class="text-center">Skills:</h6>
                            <ol class="d-flex flex-wrap pl-4" id="skills">
                                @foreach (explode(',', $applicant->skills) as $skill)
                                    <li class="ml-3">{{strtolower($skill)}}</li> &nbsp;&nbsp;
                                @endforeach
                            </ol>
                            <hr>
                            <button id="{{$applicant->applicant_id}}" class=" skills-details btn-readmore " ><i class="fas fa-eye"></i> Deatils</button>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @else No Skill Set At The moment
            @endif
        </div>
        {{-- <div id="skill-div"> --}}
            <div id="details-loader-display"></div>
            <div  id="skills-details" class="skill"></div>
        {{-- </div> --}}
</section>

@include('includes/vacancy_modal')
@include('includes.applicant_details_modal')
@endsection
