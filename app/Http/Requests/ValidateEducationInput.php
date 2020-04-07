<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateEducationInput extends FormRequest
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
            'institution' => ['required','string', 'max:225'],
            'qualification' => ['required','string', 'max:225'],
            'department' => ['required','string', 'max:225'],
            'start_month' => ['required'],
            'start_year' => ['required'],
        ];
    }
}
