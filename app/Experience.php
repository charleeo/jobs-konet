<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    protected $guarded =[];
    protected $primaryKey ='experience_id';
    public function applicants()
    {
       return $this->hasMany('App\Applicant', 'applicant_id');
    }
    public function category()
    {
       return $this->belongsTo('App\Category', 'category_id');
    }
}
