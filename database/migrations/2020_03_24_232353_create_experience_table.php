<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExperienceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('experiences', function (Blueprint $table) {
            $table->bigIncrements('experience_id');
            $table->unsignedBigInteger('applicant_id');
            $table->foreign('applicant_id')->references('applicant_id')->on('applicants')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->string('employer_name');
            $table->string('job_title');
            $table->unsignedBigInteger('state_id');
            $table->foreign('state_id')->references('state_id')->on('states')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->float('salary', 8,2);
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('category_id')->on('categories')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->string('engagement_type');
            $table->string('department');
            $table->string('start_month');
            $table->string('start_year');
            $table->string('end_month')->nullable();
            $table->string('end_year')->nullable();
            $table->string('experience_level');
            $table->text('work_description');
            $table->enum('still_working_there', ['yes', 'no'])->nullable();
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
        Schema::dropIfExists('experiences');
    }
}
