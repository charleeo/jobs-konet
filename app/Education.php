<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    protected $guarded =[];
    protected $primaryKey ='education_id';
    protected $table = 'educations';
    public function applicant()
    {
       return $this->belongsTo('App\Applicant', 'applicant_id');
    }
}
