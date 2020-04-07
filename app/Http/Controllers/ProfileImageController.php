<?php

namespace App\Http\Controllers;

use App\User;
use Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProfileImageController extends Controller
{
    // Display the form to the users
    public function createProfileImage()
    {

        $user = Auth::user();
        return view('auth.upload_image', compact('user'));
    }

    // process and store the image
    public function storeProfileImage(Request $request, $id)
    {
        if($request->hasFile('profile_photo'))
        {
            $extensions = ['jpg', 'png', 'jpeg', 'gif'];
            $profilePhoto = $request->file('profile_photo');
            $extension = $request->profile_photo->getClientOriginalExtension();

            // validate the extensions
            if(!in_array($extension, $extensions))
            {
                return back()->with('error', 'supported file types are: jpg, gif, png, jpeg');
            }

            // validate the file before saving to database
            $request->validate([
                'profile_photo' => ['required', 'image', 'dimensions:min_width=250,min_height=350']
            ]);

            $user = User::whereId($id)->first();
            // check if this user already has file in the storage folder and delete it before uploading another one
            $userOldFileString = $user->profile_photo;
            $pathToFle = public_path('images/profile_pics/'.$userOldFileString);
            if(File::exists($pathToFle))
            {
                unlink($pathToFle);
            }

            $fileName = time().'.'.$profilePhoto->getClientOriginalExtension();
            Image::make($profilePhoto)->resize(200,200)->save(public_path('images/profile_pics/'.$fileName));
            $user->profile_photo = $fileName;

            $user->save();
        }
        return back()->with('success', 'Profile Image Uploaded successfully');
    }
}


