<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateAplicantsExperienceData extends FormRequest
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
           'employer_name' => ['required', 'string', 'max:225', 'min:4'],
           'job_title' => ['required', 'string', 'max:225', 'min:4'],
           'state_id' => ['required'],
           'category_id' => ['required'],
           'engagement_type' => ['required', 'string', 'max:225', ],
           'department' => ['required', 'string', 'max:225', 'min:4'],
           'start_month' => ['required', ],
           'start_year' => ['required'],
           'experience_level' => ['required'],
           'end_month' => ['sometimes', 'nullable'],
           'end_year' => ['sometimes', 'nullable'],
           'salary' => ['required',  'max:225', 'min:4'],
           'work_description' => ['required',  'min:25'],
        ];
    }
}
