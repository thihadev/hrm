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
         'name' => "SuperAdmin",
         'slug' => 'superadmin',
         'permissions' => [
            'show-info' => true,
            'delete-info' => true,
            'update-info' => true,
            'create-info' => true,

            'show-department' => true,
            'delete-department' => true,
            'update-department' => true,
            'create-department' => true,

            'show-designation' => true,
            'delete-designation' => true,
            'update-designation' => true,
            'create-designation' => true,

            'show-user' => true,
            'delete-user' => true,
            'update-user' => true,
            'create-user' => true,
          ]
        ]);

        Role::create([
         'name' => "Admin",
         'slug' => 'admin',
         'permissions' => [
            'show-info' => true,
            'update-info' => true,
            'create-info' => true,

            'show-department' => true,
            'update-department' => true,
            'create-department' => true,

            'show-designation' => true,
            'update-designation' => true,
            'create-designation' => true,

            'show-user' => true,
         ]
        ]);

        Role::create([
         'name' => "Staff",
         'slug' => 'staff',
         'permissions' => [
            'show-info' => true,

            'show-department' => true,

            'show-designation' => true,

            'show-user' => false,

         ]
        ]);
    }
}
