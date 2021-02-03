<?php

namespace App\Providers;

use App\Applicant;
use App\Category;
use App\Experience;
use App\State;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;

class AppServiceProvider extends ServiceProvider
{
    public $id;
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        Schema::defaultStringLength(191);


        view()->composer(['*'], function(View $view){

            $view->with('engagements', ['Full Time', 'Part Time', 'Remote']);
            $view->with('experienceLevel', ['Entry Level', 'Middle Level', 'Seniour Level', 'Manager', 'Intership/Graduate Trainee', 'Team Lead']);
            $view->with('states', State::all());
            $view->with('categories', Category::all());
            $view->with('months', ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December']);
            $view->with('qualifications',  ['Degree', 'Diploma' ,'OND', 'HND', 'S.S.C.E', 'MSC/MBA', 'N.C.E', 'Others', 'PHD']);
            $view->with('designations', ['Mr', 'Mrs', 'Miss', 'Others']);
            $view->with('gender', ['Male', 'Female',  'Others']);
            if(Auth::check()){
            $view->with('applicantInfo', Applicant::where('user_id', '=',  Auth::user()->id)->first());

            }

        if(isset(Auth::user()->profile_photo) && Auth::user()->profile_photo !== 'noimage.png')
        {
            $view->with('profilePhoto', 'images/profile_pics/'.Auth::user()->profile_photo);

        }
        else
        {
            $view->with('profilePhoto', 'images/profile_pics/default-image/noimage.png');

        }

        });
    }
}
