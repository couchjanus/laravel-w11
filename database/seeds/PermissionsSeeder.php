<?php

use Illuminate\Database\Seeder;
use App\Permission;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /** Add Permissions    */
        if (Permission::where('name', '=', 'Can View Users')->first() === null) {
            Permission::create([
                'name' => 'Can View Users',
                'slug' => Str::slug('Can View Users'),
            ]);
        }
        if (Permission::where('name', '=', 'Can Create Users')->first() === null) {
            Permission::create([
                'name' => 'Can Create Users',
                'slug' => Str::slug('Can Create Users'),
            ]);
        }

        if (Permission::where('name', '=', 'Can Edit Users')->first() === null) {
            Permission::create([
                'name' => 'Can Edit Users',
                'slug' => Str::slug('Can Edit Users'),
            ]);
        }
        if (Permission::where('name', '=', 'Can Delete Users')->first() === null) {
            Permission::create([
                'name' => 'Can Delete Users',
                'slug' => Str::slug('Can Delete Users'),
            ]);
        }
    }
}
