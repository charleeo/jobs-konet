<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGenderAddOtherInformationToApplicantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('applicants', function (Blueprint $table) {
            $table->unsignedBigInteger('state_id');
            $table->foreign('state_id')->references('state_id')->on('states')->onDelete('CASCADE');
            $table->string('gender');
            $table->string('designation');
            $table->string('about_applicant')->default('Not stated')->nullable();
            $table->string('birth_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('applicants', function (Blueprint $table) {
            $table->dropForeign('applicants_state_id_foreign');
            $table->dropColumn(['state_id','gender', 'designation', 'about_applicant','birth_date']);
        });
    }
}
