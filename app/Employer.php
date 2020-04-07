<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employer extends Model
{
    protected $primaryKey = 'employer_id';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function category()
    {
        return $this->belongsTo('App\Category', 'category_id');
    }

    public function state()
    {
       return $this->belongsTo('App\State', 'state_id');
    }


}
