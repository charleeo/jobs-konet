<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;

class ChangePasswordController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth');
    }

    public function changePassword()
    {
        $title = "Changer Password";
        return view('auth.changepassword',compact('title'));
    }




    public function updatePassword(Request $request)
    {

        $request->validate([
            'old_password' => ['required','string'],
            'password' => ['required', 'min:8', 'string'],
            'c-password' => ['same:password']

        ]);

        $user = Auth::user();
        $hashed_password = $user->password;
        $textFieldPassword = $request->input('old_password');
        if(!password_verify($textFieldPassword, $hashed_password))
        {
            return back()->with('error', 'Enter your old password correctly');
        }
        else
        {

            $user->fill([
                'password' => Hash::make($request->password)
            ])->save();
            return redirect(route('home'))->with('success', 'Password Changesd Successfully');
        }
    }
}
