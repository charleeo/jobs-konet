<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fallible ='category_name';
    protected $primaryKey = 'category_id';


    public function vacancies()
    {

        return $this->hasMany('App\Employer', 'employer_id') ;
    }
}
