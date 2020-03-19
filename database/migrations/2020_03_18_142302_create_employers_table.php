<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employers', function (Blueprint $table) {
            $table->bigIncrements('employer_id');
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('role_title');
            $table->string('contact_phone_number')->default('no phone provided');
            $table->string('job_location');
            $table->string('Min_experience');
            $table->string('application_email');
            $table->string('application_deadline')->default('Not Specified');
            $table->string('salary')->nullable(true);
            $table->text('role_description');
            $table->text('role_requirements');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employers');
    }
}
