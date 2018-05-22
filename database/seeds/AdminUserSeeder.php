<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Role::find(1);

        $user = User::find(1);
        
        $user->roles()->attach($admin);    
    }
}
