<?php

namespace App\Http\Controllers;

use App\Applicant;
use App\Education;
use App\Employer;
use App\Experience;
use App\Http\Requests\ValidateAplicantsExperienceData;
use Auth;
use Illuminate\Http\Request;
use App\Http\Requests\ValidateApplicantsData;
use App\Mail\SendMyApplicationMail;
use App\Preference;
use App\User;
use App\State;
use Illuminate\Support\Facades\Mail;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\File;

class ApplicantController extends Controller
{
    // protect this route against unauthenticated users
    public function __construct()
    {
        $this->middleware('auth')->except(['show','index', 'searchForApplicant']);
    }


    public function index()
    {
        $applicants = Applicant::all();
        return view('applicants.all_applicants', compact('applicants'));
    }




    public function createApplicant($id)
    {
        $oldApplicantRecord = Applicant::where('applicant_id', '=', $id)->first();
        return view('applicants.manage_info', compact('oldApplicantRecord'));
    }



    public function storePeronalData(ValidateApplicantsData $request)
    {
        $user = Auth::user();
        $firstName = explode(' ', $user->name);
        $applicantInfo = Applicant::where('user_id', '=',  Auth::user()->id)->first();
       if(!empty($applicantInfo->user_id))
       {
           return back()->with('info', "You're not allowed to create more two records edit instead");
       }
        $applicant_personal_data = Applicant::create($request->all());
        $applicant_personal_data->save();
        return redirect(route('dashboard', [$user->users_type, $firstName[0] ]))->with('success', 'Your personal record have been created successfully');

    }

    public function updatePersonalData(ValidateApplicantsData $request, $id)
    {
        Applicant::whereApplicant_id($id)->update($request->except(['_token', '_method']));
        return back()->with('success','Your Record has been Updated successfully!');
    }

// Create Resume
    public function createResume($id)
    {
        $applicant = Applicant::whereUser_id($id)->first();
       return view('applicants.upload_resume', compact('applicant'));
    }


    public function storeResume(Request $request, $id)
    {
        $request->validate(
            [
                'resume' => 'required'
            ]
        );
        $applicant = Applicant::whereUser_id($id)->first();
        // if($request->hasFile('resume'))
        // {
            $extensions = ['docx','doc', 'txt', 'pdf'];
            $resume = $request->file('resume');
            $name = pathinfo($request->file('resume')->getClientOriginalName(), PATHINFO_FILENAME);

            $extension = $request->resume->getClientOriginalExtension();
            // dd();

            // validate the extensions
            if(!in_array($extension, $extensions))
            {
                return back()->with('error', 'supported file types are: docx, txt, pdf');
            }

            // validate the file before saving to database
            $request->validate([
                'resume' => ['required', 'max:4232']
            ]);

            $path = public_path('/files/resumes/');
            $fileName = $name.'.'.$resume->getClientOriginalExtension();
            $resume->move($path, $fileName);

            $applicant->resume = $fileName;
            $applicant->save();
        // }


        return redirect(route('home'))->with('success', 'Resume Uploaded successfully');

    }


    // method for skills creation
     public function createSkills($id)
     {
         $applicant =  Applicant::whereUser_id($id)->firstOrFail();
         $skills = explode(',',$applicant->skills);
         return view('applicants.create_skills', compact('applicant', 'skills'));
     }

     // method for skills storage
      public function saveSkills(Request $request, $id)
      {
          $request->validate([
              'skills' => ['required', 'string']
          ]);
        $applicant = Applicant::whereUser_id($id)->firstOrFail();
        $availableSkills = explode(',',$applicant->skills); //these are the skills from the database
        $skills = $request->skills ;//these are the input values

        /* here i check if skills in the record is greater than a certain amount, if it is, It remove the previously entered value/s */
        array_unshift($availableSkills, $skills); //push new input values into the arrays comimg from database
        if(count($availableSkills) > 8)
        {
            $skillsArray = explode(',', $skills);//convert the input to array

            $totalSkill = count($skillsArray);//count the total skills both from input and the database
             array_splice($availableSkills, -$totalSkill, $totalSkill);//replace the old values from the end with new one

        }
        $newSkills = rtrim(implode(',',  $availableSkills), ','); //convert the array into a string before saving to the
        $applicant->skills = $newSkills;
        $applicant->save();
        return back()->with('success','Skill Added successfully');
      }

    //   Job Application logic here
    public function applyForAjob($id, $id2, Request $request)
    {
        $employer = Employer::where('employer_id', $id)->first();
        $applicant = Applicant::where('user_id', $id2)->first();
        $subject = $request->subject;
        $mailFrom = $applicant->user->email;
        $attachment = $request->file('resume');
        $extensions = ['docx','doc', 'txt', 'pdf'];
        $written_cover_letter = $request->written_cover_letter;
        $uploaded_cover_letter = $request->uploaded_cover_letter;
        $path = realpath('/files/application/');
        $message  = 'Attached to this mail is  a copy of my resume for details ';
        $saveLetter = $request->save_letter;





        // If the Applicant chooses to upload a new resume
        if($attachment != null )
        {
            $request->validate([
                'resume' => ['file', 'max:4232' ]
            ]);

            // check for the extension type
            if(!in_array($attachment->getClientOriginalExtension(), $extensions))
            {
                return back()->withInput($request->only(['subject', 'written_cover_letter']))->with('error', 'The file extension must be in pdf, txt, doc, docx');
            }

            $name = pathinfo($attachment->getClientOriginalName(), PATHINFO_FILENAME);
            $attachment = $name.'.'.$attachment->getClientOriginalExtension();
            $request->resume->move($path, $attachment);
            $attachment = [$path.$attachment];

        }
        else if($request->user_resume != null)
        {

            $attachment = [public_path('files/resumes/'.$applicant->resume)];
        }
        // take them back to fill the new resume field
        else{ $request->validate(['resume' => 'required']); }
        // check if the input field for cover letter is empty
        if($written_cover_letter != null)
        {
            $message = $written_cover_letter;
            if($saveLetter != null)
            {
                $applicant->cover_letter = $written_cover_letter;
                $applicant->save();
            }

        }
        else if($uploaded_cover_letter != null)
        {
            $name = pathinfo($uploaded_cover_letter->getClientOriginalName(), PATHINFO_FILENAME);
            $uploaded_cover_letter = $name.'.'.$uploaded_cover_letter->getClientOriginalExtension();
            $request->uploaded_cover_letter->move($path, $uploaded_cover_letter);
            array_unshift($attachment,$path.$uploaded_cover_letter);
            $message  = 'Attached to this mail is my application letter and a copy of my resume for details ';

        }

        $data = [
            'recipient_name' => $employer->user->name,
            'bodyMessage' => $message,
            'subject' => $request->subject,
            'senderName' => $applicant->first_name. ' '. $applicant->last_name,
        ];

        Mail::to($employer->email)->send(new SendMyApplicationMail($data, $mailFrom, $subject, $attachment));

        $file = new Filesystem;
        $file->cleanDirectory($path);



        return back()->with('success', 'Application Submitted successfully');
    }

    public function show($id)
    {
        $applicant = Applicant::where('applicant_id', $id)->firstOrFail();
        $experiences =  Experience::where('applicant_id', '=', $id)->take(3)->orderBy('start_year', 'DESC')->get() ;
        $educations =  Education::where('applicant_id', '=', $id)->orderBy('start_year', 'DESC')->get() ;

        // dd($experiences);
        return view('applicants.details', compact('applicant', 'experiences', 'educations'));
    }


    // Create a search ability

    public function searchForApplicant(Request $request)
    {
        $request->validate([
            'search_name' => ['required']
        ]);
        $search = $request->search_name;

        $stateId = intval($request->state_id);

        if($stateId != '')
        {
            $applicants = Applicant::where('designation', 'LIKE', '%' .$search. '%')
                ->where([
                ['state_id', '=', $stateId]
            ])->get();
            $stateName = State::where('state_id', $stateId)

            ->pluck('state_name')
            ->first();
        }

        else
        {
            $applicants = Applicant::where('designation', 'LIKE', '%' .$search. '%')->get();
            $stateName = '';
        }

        if(count($applicants) >  0){
            return view('applicants.all_applicants',compact('applicants'));
        }
        return back()->with('info', 'No result matches your search for '. $search . ' in ' .$stateName);

    }

    // Create alert preference
    public function createAlertPreference($id)
    {
        $applicant =  Applicant::whereUser_id($id)->firstOrFail();
        return view('applicants.create_alert', compact('applicant'));
    }

    // save alert preference
    public function storeAlert(Request $request, $id)
    {
        $request->validate([
            'alert_type' => ['required', 'min:4', 'string']
        ]);
        $applicant = Applicant::whereUser_id($id)->firstOrFail();
        $alert_preference = $applicant->alert_preference;
        $alert_preference_to_array = explode(',', $alert_preference);


        $all_collection = Preference::all()->pluck('preference_name');
        $array_collection =  $all_collection->toArray();//convert the collection to array

        $alert = $request->alert_type;
        $alert = strtolower($alert);
        $alert = strtr($alert, [','=>'']);

        if($alert_preference != null){
            if(!in_array($alert, $alert_preference_to_array))
            {

                array_push($alert_preference_to_array, $alert);
                // convert to string before savingto database
                $applicant->alert_preference = strtolower (implode(',', $alert_preference_to_array));
                $applicant->save();
            }
        }
        else{
            $applicant->alert_preference = $alert;
            $applicant->save();
        }




        // this logic is to collect job alert records from various applicant and buid them up the preference table so that in subsequent time,they will only have select from the available record
        $prefernce = new Preference();//preference tbale

        $prefernce->preference_name = $alert;
        if($all_collection->count() > 0){

                if(!in_array(($alert), $array_collection))
                {
                    $prefernce->save();
                }
        }
        else{$prefernce->save();}
        return back()->with('success', 'Your JOb alert preference has been created, You can still add more');


    }

    public function deleteApplicant($id)
    {
        $user = Auth::user();
        $applicant = Applicant::where('user_id', $user->id)->firstOrFail();
        // dd($applicant->user_id." Applicant", $user->id);
        if($applicant->user_id != $user->id)
        {
            return back()->with('warning', "You can't delete other persons resource");
        }

            $resume= $applicant->resume;
            $pathToResume = public_path('files/resumes/'.$resume);

            if(File::exists($pathToResume))
            {
                unlink($pathToResume);
            }
        $applicant->delete();
        return redirect('/profile')->with('success', "Record Deleted Successfully");
    }

}

// try {

//     return response()->json("Email Sent!");
// } catch (\Exception $e) {
//     return response()->json($e->getMessage());
// }
