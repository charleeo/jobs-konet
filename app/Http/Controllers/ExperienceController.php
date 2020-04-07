<?php

namespace App\Http\Controllers;

use App\Applicant;
use App\Education;
use App\Experience;
use App\Http\Requests\ValidateAplicantsExperienceData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExperienceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function allApplicantExperience($id)
    {
        $applicantInfo = Applicant::where('user_id', '=',  Auth::user()->id)->firstOrFail();
        $ApplicantTotalExperiences = Experience::where('applicant_id', '=',  $id)->get();
        // dd($ApplicantTotalExperiences);
        return view('applicants.manage_experience', compact('applicantInfo', 'ApplicantTotalExperiences'));
    }


    public function createApplicantExperience($id)
    {

        $applicantInfo = Applicant::where('user_id', '=',  Auth::user()->id)->firstOrFail();
        $experienceCount = Experience::where('applicant_id', '=',  $id)->get();

        return view('applicants.create_experience', compact('applicantInfo', 'experienceCount',));
    }


    // Save the experience into the database
    public function storeExperirnce(ValidateAplicantsExperienceData $request)
    {
        if($request->has('end_month') || $request->has('end_year'))
        {
            $request->validate([
                'end_month' =>['required'],
                'end_year' => ['required']
            ]);
        }

        if(!$request->has('still_working_there'))
        {
            $request->validate([
                'end_month' =>['required'],
                'end_year' => ['required']
            ]);
            if($request->start_year > $request->end_year)
            {
                return back()->withInput($request->all())->with('error', 'The year you started working in that organization must be before the year you stopped. Check the start Year field and correct the error');
            }
        }
        elseif($request->has('still_working_there'))
        {

            $applicant_experience_data = Experience::create($request->except(['end_month', 'end_year']));
        }


            $applicant_experience_data = Experience::create($request->all());
            $applicant_experience_data->save();
            return back()->with('success', 'Experience added successfully');

    }

    public function editExperience($id)
    {
        $experienceInfo = Experience::where('experience_id', '=',  $id)->first();
        return view('applicants.create_experience',compact('experienceInfo'));

    }

    public function updateExperience(ValidateAplicantsExperienceData $request, $id)
    {
        if(!$request->has('still_working_there'))
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
                return back()->withInput($request->all())->with('error', 'The year you started working in that organization must be before the year you stopped. Check the start Year field and correct the error');
            }
        }
        elseif($request->has('still_working_there'))
        {

            $experienceInfo = Experience::whereExperience_id($id)->update($request->except(['_token', '_method', 'end_month', 'end_year']));
        }
        $experienceInfo = Experience::whereExperience_id($id)->update($request->except(['_token', '_method', ]));
        return back()->with('success','Your Record has been Updated successfully!');
    }
}
