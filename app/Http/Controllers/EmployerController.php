<?php

namespace App\Http\Controllers;

use App\Applicant;
use App\Category;
use App\Employer;
use App\Mail\ReachOutToApplicantMail;
use App\Notifications\NewJobNotification;
use App\State;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class EmployerController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified'])->except(['index', 'show', 'allVacancies', 'searchForVacancy','reachOut','getvacancyDetails']);
    }



    // Return every vacancy that is not yet expired
    public function allVacancies()
    {
        $title = " Vacancies";
        $vacancies = Employer::where('clossing_date', '>=', date('Y-m-d'))->get();
        return view('vacancies.all_vacancies',compact('vacancies','title'));
    }

        // Search for a particular vacancy
        public function searchForVacancy(Request $request)
    {
        $request->validate([
            'search_name' => ['required']
        ]);
        $search = $request->search_name;

        $stateId = intval($request->state_id);

        if($stateId != '')
        {
            $vacancies = Employer::where('role_title', 'LIKE', '%' .$search. '%')
                ->where([
                ['clossing_date', '>=', date('Y-m-d')],
                ['state_id', '=', $stateId]
            ])->get();
            $stateName = State::where('state_id', $stateId)
            ->pluck('state_name')
            ->first();
        }

        else
        {
            $vacancies = Employer::where('role_title', 'LIKE', '%' .$search. '%')->orWhere('summary', 'LIKE', '%'.$search.'%')->where([
                ['clossing_date', '>=', date('Y-m-d')]
            ])->get();
            $stateName = '';
        }

        if(count($vacancies) >  0){
            $title = "Searched result";
            return view('vacancies.searched_vacancies',compact('vacancies','title'));
        }
        return back()->with('info', 'No result matches your search for '. $search . ' in ' .$stateName);

    }

    public function create()
    {
        $action = route('employer.store');
            $user = Auth::user();
            $title = $user->name." vacancy creation";
            return view('employers.create_job', compact('action', 'title'));


    }


    public function store(Request $request)
    {
        $request->validate([
            'role_title' => ['required', 'string', 'max:225'],
            'salary' => [ 'nullable'],
            'summary' => ['required', 'string',   'min:15'],
            'state_id' => ['required'],
            'category_id' => ['required'],
            'email' => ['required', 'string'],
            'phone' => ['string', 'min:9', 'max:15', 'nullable'],
            'min_experience' => ['required'],
            // 'description' => ['required', 'min:20', 'string'],
            // 'requirements' => ['required', 'min:20', 'string'],
            'clossing_date' => ['required', 'date'],

        ]);
        if(!filter_var($request->email, FILTER_VALIDATE_EMAIL) AND !filter_var($request->email, FILTER_VALIDATE_URL)){
            return back()->with('error', 'The application email field can either be an email address or a valid URL');
        }
        // $users = User::where('users_type', '=', 'applicant')->get();
        $users = Applicant::all();
        // dd($users);
        $title = $request->role_title;
        $employer = Employer::create($request->all());
        $employer->save();
        $id = $employer->employer_id;
        $category_id = $employer->category_id;

        $details = [
            'greeting' => 'Hi! There',
            'body' => 'New '.$title. ' Role For You ',
            'thanks' => 'Thank you for using our platform!',
            'actionText' => 'View Details',
            'actionURL' => url(route('vacancy.details',[$id, $category_id, $title])),
        ];


        // Notification::send($users, new NewJobNotification($details));
        foreach($users as $user)
        {

            Notification::route('mail', $user->applicant_email)
            ->notify(new NewJobNotification($details));
        }

        return back()->with('success','Vacancy created successfully!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $id2, Request $request)
    {
        $similarJobs = Employer::with('category')
        ->where('category_id', $id2)
        ->where('employer_id', '!=', $id)
        ->where('clossing_date', '>=', date('Y-m-d'))
        ->take(4)->inRandomOrder()->get();

        // This is to check
        if(Auth::check() == true){

            $user = Auth::user()->id;
            $applicantInfo = Applicant::where('user_id', $user)->first();
            if($applicantInfo == null){
                $applicantInfo = '';
            }
        }
        else{
            $applicantInfo = '';
        }
        // else{$applicantInfo = '';}

        $title = " vacancies details";

        $vacancy = Employer::where('employer_id','=', $id)->where('clossing_date', '>=', date('Y-m-d'))->firstOrFail();
        return view('vacancies.vacancy_details', compact('vacancy','similarJobs', 'applicantInfo','title'));
    }


    /**This function will return all the vacancies by a particular employer which are still within the dead line  date */

    public function EmployerJobsLIstings($id)
    {
        $user = User::find($id);
        $title= "Vacancies by ".$user->name;
        $vacancies = Employer::where('user_id','=', $id)->where('clossing_date', '>=', date('Y-m-d'))->get();
        if($user->users_type == 'employer')
        {

            return view('employers.all_vacancies', compact('vacancies','title'));
        }
        else{
            return back()->with('error', 'Access denied');
        }
    }



    public function edit($id)
    {
        $title= Auth::user()->name ." edit vacancy ";
        $action = route('employer.update', ['id' => $id]);
        $vacancy = Employer::find($id);
        return view('employers.create_job', compact('vacancy','action','title'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'role_title' => ['required', 'string', 'max:225'],
            'salary' => [ 'nullable'],
            'summary' => ['required', 'string',   'min:15'],
            'state_id' => ['required'],
            'email' => ['required', 'string'],
            'phone' => ['string', 'min:9', 'max:15', 'nullable'],
            'min_experience' => ['required'],
            'description' => ['required', 'min:20', 'string'],
            'requirements' => ['required', 'min:20', 'string'],
            'clossing_date' => ['required', 'date'],
        ]);

        if(!filter_var($request->email, FILTER_VALIDATE_EMAIL) AND !filter_var($request->email, FILTER_VALIDATE_URL)){
            return back()->with('error', 'The application email field can either be an email address or a valid URL');
        }
            Employer::whereEmployer_id($id)->update($request->except(['_token', '_method']));

        return back()->with('success','Vacancy Updated successfully!');
    }

    public function destroy($id)
    {
        Employer::find($id)->delete();
        return back()->with('success','Vacancy Deleted successfully!');
    }

    public function reachOut(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'message'=>'required',
            'email'=>['required', 'email'],
            'subject' =>'required'
        ]);
        $name = $request->name;
        $message = $request->message;
        $email = $request->email;
        $subject = $request->subject;
        $applicant_id = $request->applicant_id;
        $applicant = Applicant::where('applicant_id', $applicant_id)->firstOrFail();

        $data = [
            'recipient_name' => $applicant->user->name,
            'bodyMessage' => $message,
            'subject' => $subject,
            'senderName' => $name,
            'email' => $email,

        ];

        Mail::to($applicant->applicant_email)->send(new ReachOutToApplicantMail($data, $email));
        return back()->with('success', 'Message Sent to '.$applicant->user->name);
    }
    public function getvacancyDetails($id){
      $vacancy = Employer::where('employer_id','=',$id)->first();
      return view('vacancies.vacancy_details_with_ajax', compact('vacancy'));
    }

}
