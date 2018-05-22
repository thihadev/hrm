<?php

use Illuminate\Database\Seeder;
use App\Designation;

class DesignationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Designation::create([
        	'name' => 'Manager'
        ]);

        Designation::create([
        	'name' => 'Senior'
        ]);

        Designation::create([
        	'name' => 'Staff'
        ]);
    }
}
