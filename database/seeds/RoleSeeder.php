<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
         'name'  => "ROLE_SUPERADMIN",
         'description'  => 'This is Superadmin page.',
         
        ]);    
    }
}
