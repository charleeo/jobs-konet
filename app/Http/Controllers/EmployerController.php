<?php

namespace App\Http\Controllers;

use App\Employer;
use App\State;
use App\StateModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmployerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $states = State::all();
        return view('employers.create_job', compact('states'));
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    public function store(Request $request)
    {
      $validator =  $request->validate([
            'role_title' => ['required', 'string', 'max:225'],
            'salary' => [ 'nullable'],
            'address' => ['required', 'string',  'max:225', 'min:15'],
            'state_id' => ['required'],
            'email' => ['required', 'string', 'email'],
            'phone' => ['string', 'min:9', 'max:15', 'nullable'],
            'min_experience' => ['required'],
            'description' => ['required', 'min:20', 'string'],
            'requirements' => ['required', 'min:20', 'string'],
            'clossing_date' => ['required', 'date'],
        ]);
        $employer = Employer::create($request->all());
        $employer->save();

        return response()->json('Form is successfully validated and data has been saved');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
