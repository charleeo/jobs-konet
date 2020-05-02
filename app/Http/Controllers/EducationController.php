<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Education;
use App\Applicant;
use App\Http\Requests\ValidateEducationInput;
use Route;
use Illuminate\Support\Facades\Auth;

class EducationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function createApplicantEducation($id)
    {


        $applicantInfo = Applicant::where('user_id', '=',  Auth::user()->id)->firstOrFail();
        return view('applicants.create_education', compact('applicantInfo'));
    }



    public function storeEducation(ValidateEducationInput $request)
    {
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
            elseif($request->has('still_working_there'))
            {

                $applicant_education_data = Education::create($request->except(['end_month', 'end_year']));
            }


            $applicant_education_data = Education::create($request->all());
            $applicant_education_data->save();
            return back()->with('success', 'Education added successfully');

    }


    public function getAllEducationRecordsByAplicant($id)
    {
        $applicantInfo = Applicant::where('user_id', '=',  Auth::user()->id)->firstOrFail();
        $educations = Education::where('applicant_id', '=', $id)->get();
        return view('applicants.view_education',compact('educations', 'applicantInfo'));
    }

    public function  editEducation($id)
    {
        $education = Education::whereEducation_id($id)->firstOrFail();
        $applicantInfo = Applicant::where('user_id', '=',  Auth::user()->id)->firstOrFail();
        return view('applicants.create_education', compact('applicantInfo', 'education' ));
    }


    public function updateEducation(ValidateEducationInput $request, $id)
    {
        if(!$request->has('still_studying'))
        {
        if($request->has('end_month') || $request->has('end_year'))
        {
            $request->validate([
                'end_month' =>['required'],
                'end_year' => ['required']
            ]);
        }

            $request->validate([
                'end_month' =>['required'],
                'end_year' => ['required']
                ]);

                if($request->start_year > $request->end_year)
                {
                    return back()->withInput($request->all())->with('error', 'The year you started schooling must be before the year you graduated. Check the start Year field and correct the error');
                }
        }
        if($request->still_working_there)
        {

            Education::whereEducation_id($id)->update($request->except(['_token', '_method', 'end_month', 'end_year']));
        }

         Education::whereEducation_id($id)->update($request->except(['_token', '_method', ]));
        return back()->with('success','Your Record has been Updated successfully!');
    }

    // public function deleteEducation($id)
    // {
    //     $applicantId = Applicant::where('user_id',Auth::user()->id)->firstOrFail();
    //     if($applicantId->user_id !=Auth::user()->id )
    //     {
    //         return
    //     }
    // }
}
