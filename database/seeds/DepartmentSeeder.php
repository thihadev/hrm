<?php

use Illuminate\Database\Seeder;
use App\Department;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Department::create([
        	'name' => 'IT'
        ]);

        Department::create([
        	'name' => 'Sale'
        ]);

        Department::create([
        	'name' => 'Service'
        ]);
    }
}
