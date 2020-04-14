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
use App\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Filesystem\Filesystem;


class ApplicantController extends Controller
{
    // protect this route against unauthenticated users
    public function __construct()
    {
        $this->middleware('auth')->except('show');
    }


    public function index()
    {
        $applicants = Applicant::all();
        return view('applicants.all', compact('applicants'));
    }


    // Show the applicant on the home page
    // public function showApplicantOnHomePage()
    // {
    //     $applicantsHomeView = Applicant::where('skills', '!=', null)->take(4)->inRandomOrder()->get();
    //     return view('welcome', compact('applicantsHomeView'));
    //     // dd($applicants);
    // }

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
        $experiences =  Experience::where('applicant_id', '=', $id)->take(2)->orderBy('start_year', 'DESC')->get() ;

        // dd($experiences);
        return view('applicants.details', compact('applicant', 'experiences'));
    }
}

// try {

//     return response()->json("Email Sent!");
// } catch (\Exception $e) {
//     return response()->json($e->getMessage());
// }
