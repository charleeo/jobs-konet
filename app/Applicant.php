<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Applicant extends Model
{
    protected $primaryKey = 'applicant_id';
    protected $guarded =[];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function educations()
    {

       return $this->hasMany('App\Education', 'education_id');
    }
    public function experiences()
    {

       return $this->hasMany('App\Experience', 'experience_id');
    }
    public function state()
    {

       return $this->belongsTo('App\State', 'state_id');
    }
}
