<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function userType(Request $request, $useType )
    {

        if (Gate::allows('user_type', Auth::user())) {
            $user = User::where('users_type', $useType)->first();
            if(isset($user) && $user->users_type == 'applicant'){

                return view('applicants.applicant', compact('user'));
            }
           else if(isset($user) && $user->users_type == 'employer'){

                return view('employers.employer', compact('user'));
            }
            return 'User not found';
        }

        else{ return " You don't have the permision to acces that page ";}
    }

}
