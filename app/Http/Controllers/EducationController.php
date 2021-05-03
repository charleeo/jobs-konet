<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Education;
use App\Applicant;
use App\Http\Requests\ValidateEducationInput;
use App\User;
use Route;
use Illuminate\Support\Facades\Auth;

class EducationController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }


    public function createApplicantEducation($id)
    {

        $title = Auth::user()->name." Education creation page";
        $applicantInfo = Applicant::where('user_id', '=',  Auth::user()->id)->firstOrFail();
        return view('applicants.create_education', compact('applicantInfo', 'title'));
    }



    public function storeEducation(ValidateEducationInput $request)
    {
        $brief_description = $request->brief_description;

        if(!empty($brief_description) || $brief_description !=''){
            $request->validate([
                'brief_description' =>'min:20'
            ]);
          }

        if(!$request->has('still_studying'))
        {
            $request->validate([
                'end_month' =>['required'],
                'end_year' => ['required']
                ]);

                if($request->start_year > $request->end_year)
                {
                    return back()->withInput($request->all())->with('error', 'The year you started schooling must be before the year you graduated. Check the start Year field and correct the error');
                }
            }

            $applicant_education_data = Education::create($request->all());
            $applicant_education_data->save();
            return back()->with('success', 'Education added successfully!');

    }


    public function getAllEducationRecordsByAplicant($id)
    {
        $title = Auth::user()->name." Education Details";
        $applicantInfo = Applicant::where('user_id', '=',  Auth::user()->id)->firstOrFail();

        $educations = Education::where('applicant_id', '=', $id)->get();
        $pathInfo= explode('/', urldecode( parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)));

        if(Auth::user()->id != $pathInfo[4]){
            return back()->with('error','You are not allowed to view that resources');
        }
        return view('applicants.view_education',compact('educations', 'applicantInfo','title'));
    }

    public function  editEducation($id)
    {
        $title = Auth::user()->name." Education Editing Page";
        $education = Education::whereEducation_id($id)->firstOrFail();
        $applicantInfo = Applicant::where('user_id', '=',  Auth::user()->id)->firstOrFail();
        return view('applicants.create_education', compact('applicantInfo', 'education','title' ));
    }


    public function updateEducation(ValidateEducationInput $request, $id)
    {

       $education = Education::find($id);

       $still_studying = $request->still_studying;
       $brief_description = $request->brief_description;

       if(!empty($brief_description) || $brief_description !=''){
         $request->validate([
             'brief_description' =>'min:20'
         ]);
       }

        if($still_studying !='yes')
        {
            $request->validate([
            'end_month' =>['required'],
            'end_year' => ['required']
            ]);
            $still_studying = "no";
            if($request->start_year > $request->end_year)
            {
                return back()->withInput($request->all())->with('error', 'The year you started schooling must be before the year you graduated. Check the start Year field and correct the error');
            }

        }
        $education->fill([
            'still_studying' =>$still_studying,
            'end_month' => $request->end_month,
            'end_year' => $request->end_year,
            'institution' => $request->institution,
            'qualification' => $request->qualification,
            'department' => $request->department,
            'start_month' => $request->start_month,
            'start_year' =>  $request->start_year,
            'brief_description' =>$brief_description,
            ])->save();
            return back()->with('success','Your Record has been Updated successfully!');
    }

    public function deleteEducation($id)
    {
        $applicantId = Applicant::where('user_id',Auth::user()->id)->firstOrFail();
        if($applicantId->user_id !=Auth::user()->id )
        {
            return back()->with('error','You can\'t access that resource');
        }

        $education = Education::where('education_id','=', $id);
        $education->delete();
        return back()->with('success','Education record deleted successfully');
    }
}
