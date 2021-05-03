<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StateSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('states')->insert([
            'state_name' => 'Abia'
        ]);
        DB::table('states')->insert([
            'state_name' => 'Adamawa'
        ]);
        DB::table('states')->insert([
            'state_name' => 'Akwa Ibom'
        ]);
        DB::table('states')->insert([
            'state_name' => 'Anambra'
        ]);
        DB::table('states')->insert([
            'state_name' => 'Enugu'
        ]);
        DB::table('states')->insert([
            'state_name' => 'Edo'
        ]);
        DB::table('states')->insert([
            'state_name' => 'Imo'
        ]);
        DB::table('states')->insert([
            'state_name' => 'Cross River'
        ]);

        DB::table('states')->insert([
            'state_name' => 'Benue'
        ]);
        DB::table('states')->insert([
            'state_name' => 'Borno'
        ]);

        DB::table('states')->insert([
            'state_name' => 'Gombe'
        ]);

        DB::table('states')->insert([
            'state_name' => 'Kebi'
        ]);

        DB::table('states')->insert([
            'state_name' => 'Kogi'
        ]);
        DB::table('states')->insert([
            'state_name' => 'Kano'
        ]);

        DB::table('states')->insert([
            'state_name' => 'Katsina'
        ]);

        DB::table('states')->insert([
            'state_name' => 'Kwara'
        ]);

        DB::table('states')->insert([
            'state_name' => 'Nasaraw'
        ]);

        DB::table('states')->insert([
            'state_name' => 'Niger'
        ]);

        DB::table('states')->insert([
            'state_name' => 'Enugu'
        ]);

        DB::table('states')->insert([
            'state_name' => 'Jigawa'
        ]);
        DB::table('states')->insert([
            'state_name' => 'Zamfara'
        ]);
        DB::table('states')->insert([
            'state_name' => 'Logos'
        ]);

        DB::table('states')->insert([
            'state_name' => 'Ondo'
        ]);
        DB::table('states')->insert([
            'state_name' => 'Ogun'
        ]);

        DB::table('states')->insert([
            'state_name' => 'Osun'
        ]);

        DB::table('states')->insert([
            'state_name' => 'Oyo'
        ]);

        DB::table('states')->insert([
            'state_name' => 'Emboyi'
        ]);
        DB::table('states')->insert([
            'state_name' => 'Delta'
        ]);

        DB::table('states')->insert([
            'state_name' => 'Rivres'
        ]);

        DB::table('states')->insert([
            'state_name' => 'Bayelsa'
        ]);

        DB::table('states')->insert([
            'state_name' => 'Platue'
        ]);

        DB::table('states')->insert([
            'state_name' => 'Sokoto'
        ]);

        DB::table('states')->insert([
            'state_name' => 'Bauchi'
        ]);

        DB::table('states')->insert([
            'state_name' => 'Yobe'
        ]);

        DB::table('states')->insert([
            'state_name' => 'Taraba'
        ]);

        DB::table('states')->insert([
            'state_name' => 'Kaduna'
        ]);

        DB::table('states')->insert([
            'state_name' => 'FCT Abuja'
        ]);
    }
}
