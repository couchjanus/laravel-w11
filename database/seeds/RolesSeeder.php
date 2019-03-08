<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Role::where('name', '=', 'admin')->first() === null) {
            $adminRole = Role::create([
                'name' => 'admin',
                'slug' => 'admin',
           ]);
        }

        if (Role::where('name', '=', 'manager')->first() === null) {
            $userRole = Role::create([
                'name' => 'manager',
                'slug' => 'manager',
            ]);
        }
        
        if (Role::where('name', '=', 'writer')->first() === null) {
            $userRole = Role::create([
                'name' => 'writer',
                'slug' => 'writer',
            ]);
        }
        if (Role::where('name', '=', 'user')->first() === null) {
            $userRole = Role::create([
                'name' => 'user',
                'slug' => 'user',
            ]);
        }

        if (Role::where('name', '=', 'unverified')->first() === null) {
            $userRole = Role::create([
                'name' => 'unverified',
                'slug' => 'unverified',
            ]);
        }

    }
}
