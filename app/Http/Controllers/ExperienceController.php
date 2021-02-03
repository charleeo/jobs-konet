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
        $title = Auth::user()->name." experiences records";
        $applicantInfo = Applicant::where('user_id', '=',  Auth::user()->id)->firstOrFail();
        $ApplicantTotalExperiences = Experience::where('applicant_id', '=',  $id)->get();

        $pathInfo= explode('/', urldecode( parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)));


        if(Auth::user()->id != $pathInfo[4]){
            return back()->with('error','You are not allowed to view that resources');
        }

        return view('applicants.manage_experience', compact('applicantInfo', 'ApplicantTotalExperiences','title'));
    }


    public function createApplicantExperience($id)
    {
        $user = Auth::user();
        $title = $user->name." experience record creation";
        $applicantInfo = Applicant::where('user_id', '=',  $user->id)->firstOrFail();
        $experienceCount = Experience::where('applicant_id', '=',  $id)->get();

        return view('applicants.create_experience', compact('applicantInfo', 'experienceCount','title'));
    }


    // Save the experience into the database
    public function storeExperirnce(ValidateAplicantsExperienceData $request)
    {

        if($request->still_working_there !=='yes')
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

        $applicant_experience_data = Experience::create($request->all());
        $applicant_experience_data->save();
        return back()->with('success', 'Experience added successfully');
    }

    public function editExperience($id)
    {
        $title = "Edit experience";
        $experienceInfo = Experience::where('experience_id', '=',  $id)->first();

        $applicant         = Applicant::where('user_id','=',  Auth::user()->id)->firstOrFail();
         if($applicant->applicant_id !== $experienceInfo->applicant_id){
            return back()->with('error',"You don't have the permission to view this resource");
         }
        return view('applicants.create_experience',compact('experienceInfo','title'));

    }

    public function updateExperience(ValidateAplicantsExperienceData $request, $id)
    {
        $still_working_there = $request->still_working_there;
        if($request->still_working_there !='yes')
        {
            $still_working_there = 'no';
            $request->validate([
            'end_month' =>['required'],
            'end_year' => ['required']
            ]);
            if($request->start_year > $request->end_year)
            {
                return back()->withInput($request->all())->with('error', 'The year you started working in that organization must be before the year you stopped. Check the start Year field and correct the error');
            }
        }

          Experience::find($id)->fill([
            'employer_name' => $request->employer_name,
            'job_title'     => $request->job_title,
            'state_id'      => $request->state_id,
            'category_id'   => $request->category_id,
            'engagement_type'=>$request->engagement_type,
            'department'   =>  $request->department,
            'start_month'  =>  $request->start_month,
            'end_month'  =>  $request->end_month,
            'start_year'  =>  $request->start_year,
            'end_year'  =>  $request->end_year,
            'experience_level' => $request->experience_level,
            'salary'    =>  $request->salary,
            'work_description' => $request->work_description,
            'still_working_there' => $still_working_there,
          ])->save();
        return back()->with('success','Your Record has been Updated successfully!');
    }

    public function deleteExperience($id,$id2)
    {
        $experience = Experience::where('experience_id',"=", $id)
        ->where('applicant_id','=',$id2)->first();
        $applicant         = Applicant::where('user_id','=',  Auth::user()->id)->firstOrFail();
         if($applicant->applicant_id !== $experience->applicant_id){
            return back()->with('error',"You don't have the permission to perfom this operation");
         }
         if($experience->delete()){
             return back()->with('success','Experience record deleted successflly');
         }
    }

    public function detailExperience($id,$id2)
    {
        $title =" Eperience Details";
        $experience = Experience::where('experience_id',"=", $id)
        ->where('applicant_id','=',$id2)->first();
         if(!$experience || empty($experience)){
             return back()->with('error','Experience record not found');
         }

         $applicant         = Applicant::where('user_id','=',  Auth::user()->id)->firstOrFail();

         if($applicant->applicant_id !== $experience->applicant_id){
            return back()->with('error',"You don't have the permission to view this resource");
         }
         return view('applicants.experience_details',compact('experience','title'));
    }
}
