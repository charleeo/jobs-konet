<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEducationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('educations', function (Blueprint $table) {
            $table->bigIncrements('education_id');
            $table->unsignedBigInteger('applicant_id')->nullable();
            $table->foreign('applicant_id')->references('applicant_id')->on('applicants')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->string('institution');
            $table->string('qualification');
            $table->string('department');
            $table->string('start_month');
            $table->string('start_year');
            $table->enum('still_studying', ['yes', 'no'])->nullable();
            $table->string('end_month')->nullable();
            $table->string('end_year')->nullable();
            $table->text('brief_description')->nullable();
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
        Schema::dropIfExists('educations');
    }
}
