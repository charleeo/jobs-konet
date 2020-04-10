<?php
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', 'ApplicantController@showApplicantOnHomePage');

Auth::routes(['verify'=>true]);

Route::get('/profile', 'HomeController@index')->name('home');
Route::get('/profile/edit/{id}', 'HomeController@editProfile')->name('users.edit-profile');
Route::PATCH('/profile/update/{id}', 'HomeController@updateProfile')->name('users.update-profile');

Route::get('/users/logout', 'Auth\LoginController@userlogout')->name('user.logout');


// Employers Routes

Route::prefix('vacancy')->group(function(){
Route::get('/all-vacancy', 'EmployerController@allVacancies')->name('all-vacancies');
Route::post('/search-vacancy', 'EmployerController@searchForVacancy')->name('search-vacancies');

Route::get('/create_job', 'EmployerController@create')->name('employer.create_job');

Route::post('/store', 'EmployerController@store')->name('employer.store');
Route::get('/edit/{id}', 'EmployerController@edit')->name('employer.edit');
Route::PATCH('/update/{id}', 'EmployerController@update')->name('employer.update');
Route::get('/all-vacancies/{id}', 'EmployerController@EmployerJobsLIstings')->name('employer.all-vacancies');
Route::get('/delete/{id}', 'EmployerController@destroy')->name('employer.delete-vacancy');
});

// Vacancies
Route::get('vacancies/{id}/{category_id}/{title}', 'EmployerController@show')->name('vacancy.details');

// Employers age
Route::get('vacancies/{id}/{title}', 'EmployerController@show')->name('vacancy-employer.details');
Route::get('/', 'EmployerController@index');


// Admin route
Route::any('/users/{type}/{name}', 'HomeController@userType')->name('dashboard');

// changing password
Route::get('/users/change-password', 'ChangePasswordController@changePassword')->name('users.change.passwrod');

Route::PATCH('/users/updatepassword', 'ChangePasswordController@updatePassword')->name('users.update.passwrod');

Route::prefix('admin')->group(function(){

Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');

Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');

Route::get('/', 'AdminController@index')->name('admin.dashboard');
Route::get('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');

// Reset password

Route::post('/password/email', "Auth\AdminForgotPasswordController@sendResetLinkEmail")->name('admin.password.email') ;
Route::get('/password/reset', 'Auth\AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.request') ;

Route::post('/password/reset', "Auth\AdminResetPasswordController@reset");
Route::get('/password/reset/{token}', "Auth\AdminResetPasswordController@showResetForm")->name('admin.password.reset') ;
});

// saving applicants information
Route::prefix('applicants')->group(function(){
    Route::post('/personal-data', 'ApplicantController@storePeronalData')->name('applicant.peronal.data');

    Route::get('/creating-profile/{id}/personal-create-data', 'ApplicantController@createApplicant')->name('applicant.data-create');

    Route::get('edit-profile/{id}/{applicant_id}/personal-edit-data', 'ApplicantController@createApplicant')->name('applicant.data-edit');

    Route::PATCH('/{id}/personal-update-data', 'ApplicantController@updatePersonalData')->name('applicant.data-update');

    Route::get('/creating-experience/{id}/{user}/experienc-create', 'ExperienceController@createApplicantExperience')->name('applicant.experience-add');

    Route::post('/{id}/{user}/experience', 'ExperienceController@storeExperirnce')->name('applicant.experience-save');

    Route::get('/managing-eperience/{id}/{user}/experience-all', 'ExperienceController@allApplicantExperience')->name('applicant.experience-all');

    Route::get('/editing-experience/{id}/{applicant_id}/', 'ExperienceController@editExperience')->name('applicant.experience-edit');

    Route::PATCH('/updating-experience/{id}/{applicant_id}/', 'ExperienceController@updateExperience')->name('applicant.experience-update');


    Route::get('/creating-education/{id}/{user}/education', 'EducationController@createApplicantEducation')->name('applicant.education-create');

    Route::get('/editing-education/{id}/{user}/education', 'EducationController@editEducation')->name('applicant.education-edit');

    Route::post('/saving-education/{id}/{user}/education', 'EducationController@storeEducation')->name('applicant.education-save');

    Route::PATCH('/update-education/{id}/{user}/education', 'EducationController@updateEducation')->name('applicant.education-update');

    Route::get('/viewing-education/{id}/{user}/education-all', 'EducationController@getAllEducationRecordsByAplicant')->name('applicant.education-all');

    Route::get('/resume/{id}/create-resume', 'ApplicantController@createResume')->name('applicant.create-cv');

    Route::post('/{id}/store-resume', 'ApplicantController@storeResume')->name('applicant.save-cv');

    Route::get('/skills/{id}/create-skills', 'ApplicantController@createSkills')->name('applicant.create-skills');

    Route::post('/{id}/save-skills', 'ApplicantController@saveSkills')->name('applicant.save-skills');
    Route::post('/apply-for-job/{jobId}/{applicantId}', 'ApplicantController@applyForAjob')->name('send-my-application');
    Route::get('/applicant-details/{id}', 'ApplicantController@show')->name('applicant.details');
});

// Route for creating profile image
Route::get('auth/create-photo', 'ProfileImageController@createProfileImage')->name('profile-upload');


Route::post('auth/{id}/save-profile-photo', 'ProfileImageController@storeProfileImage')->name('profile-store');

// sending application mails
