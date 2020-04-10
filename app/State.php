<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $fallible = 'state_name';
    protected $primaryKey = 'state_id';

    public function vacancies()
    {
        return $this->hasMany('App\Employer', 'employer_id');
    }
    public function applicants()
    {
        return $this->hasMany('App\Applicant', 'applicant_id');
    }

}

