<?php
use App\Applicant;
use App\User;

function checkForApplicantSkills($id){
    $userSkillCheck = Applicant::where('user_id','=',$id)->first()->toArray();

    return $userSkillCheck;
}

define('Authorization',  base64_encode('MK_PROD_XN9UVZ7C2N:2Q8RB28UBFLZUXCPG8HKTAGM6KAY4UUR'));



