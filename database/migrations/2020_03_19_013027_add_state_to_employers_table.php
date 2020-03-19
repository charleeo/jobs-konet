<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStateToEmployersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employers', function (Blueprint $table) {
            $table->bigInteger('states_id');
            $table->foreign('states_id')->references('state_id')->on('states');
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
            $table->dropColumn(['state']);        });
    }
}
