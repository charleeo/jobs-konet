<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Applicant extends Model
{
    protected $primaryKey = 'applicant_id';
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
