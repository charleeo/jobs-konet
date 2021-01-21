<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileSettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function switchUsage(){
        $title = "switch account option";
        return view('settings.switch_usage', compact('title'));
    }

    public function saveSwitchUsage(Request $request){
        $user = Auth::user();
        $user_type = $request->user_type;
        $message = ['error'=>"Could not switch account. Please try again"];
        if( $user->fill([ 'users_type' =>$user_type ])->save()){

            $message = ['success'=>"Account successfully switched to ".strtoupper( " '$user_type option'")];
        }

        return json_encode($message);
    }
}
