<?php

namespace App\Http\Controllers;

use App\Applicant;
use App\Category;
use App\State;
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

    public function userType(Request $request, $userType )
    {

        if (Gate::allows('user_type', Auth::user())) {
            $user = User::where('users_type', $userType)->first();
            $applicantInfo = Applicant::where('user_id', '=',  Auth::user()->id)->first();
            // dd($applicantInfo->user_id);

            if(isset($user) && $user->users_type == 'applicant'){

                return view('applicants.applicant', compact('user', 'applicantInfo'));
            }
           else if(isset($user) && $user->users_type == 'employer'){

                return view('employers.employer', compact('user'));
            }
            return 'User not found';
        }

        else{ return " You don't have the permision to acces that page ";}
    }

    // Edit applicants personal data
    public function editApplicantData($id, $userType)
    {
        $user = User::where('users_type', $userType)->first();
        $applicantInfo = Applicant::where('applicant_id','=', $id)->firstOrFail();
        return view('applicants.applicant', compact('user', 'applicantInfo'));
    }

    public function editProfile($id)
    {
        $user = Auth::user()->find($id);
        return view('auth.edit-register',compact('user'));
    }

     public function updateProfile(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'min:5', 'max:225'],
            'phone' => [ 'required', 'min:8', 'max:15'],

        ]);
            $user = User::find($id);
            $userName = explode(' ', $user->name);

            User::whereId($id)->update($request->only(['name', 'phone']));

            if(isset($user->users_type) && $user->users_type == 'applicant'){

                return redirect(route('dashboard', ['type'=>$user->users_type, 'name' => $userName[0]]))->with('success','Profile Updated successfully!');;
            }
           else if(isset($user->users_type) && $user->users_type == 'employer'){

                return redirect(route('dashboard', ['type'=>$user->users_type, 'name' => $userName[0]]))->with('success','Profile Updated successfully!');;
            }
    }



}
