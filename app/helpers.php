<?php
use App\Applicant;
use App\User;

function checkForApplicantSkills($id){
    $userSkillCheck = Applicant::where('user_id','=',$id)->first()->toArray();

    return $userSkillCheck;
}
