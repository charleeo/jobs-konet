<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddJobSummaryToEmployersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employers', function (Blueprint $table) {
            $table->string('engagement');
            $table->string('experience_level');
            $table->text('working_hours');
            $table->string('min_qualification');
            $table->text('skills_and_qualifications');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employers', function (Blueprint $table) {
            $table->dropColumn(['engagement', 'experience_level', 'working_hours', 'min_qualification', 'skills_and_qualifications']);
        });
    }
}
