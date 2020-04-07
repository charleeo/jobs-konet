<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateApplicantsData extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'gender' => ['required', 'string', 'max:15', 'min:3'],
            'designation' => ['required'],
            'about_applicant' => ['sometimes', 'min:20', 'string', 'nullable'],
            'birth_date' => ['required'],
            'state_id' => ['required'],
            'first_name' => ['required'],
            'other_names' => ['required'],
            'phone' => ['required', 'numeric',],
            'applicant_email' => ['required', 'email'],
        ];
    }

    public function messages()
{
    return [
        'gender.required' => 'Gender field is required',
        'phone.required'  => 'Phone filed is required',
        'birth_date.required'  => 'Date of birth filed is required',
        'other_names.required'  => 'Please supply your surname and last name in the other names field ',
        'phone.numeric'  => 'Phone filed must be number or numeric values only',
        'first_name.required' => 'An first name field is required',
        'state_id.required' => 'Please select your state of residence',
    ];
}
}
