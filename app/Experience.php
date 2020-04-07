<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    protected $guarded =[];
    protected $primaryKey ='experience_id';
    public function applicant()
    {
       return $this->belongsTo('App\Applicant', 'applicant_id');
    }
}
