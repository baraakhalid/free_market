<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;


class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          //
        //************************ADMIN PERMISSIONS ************************
        // Permission::create(['name' => 'Create-', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Read-', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Update-', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Delete-', 'guard_name' => 'admin']);

       

        Permission::create(['name' => 'Read-Permissions', 'guard_name' => 'admin']);

        Permission::create(['name' => 'Create-Admin', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Read-Admins', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Update-Admin', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Delete-Admin', 'guard_name' => 'admin']);
        
        Permission::create(['name' => 'Create-User', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Read-Users', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Update-User', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Delete-User', 'guard_name' => 'admin']);


        Permission::create(['name' => 'Create-City', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Read-Cities', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Update-City', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Delete-City', 'guard_name' => 'admin']);

        Permission::create(['name' => 'Create-vendor', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Read-vendors', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Update-vendor', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Delete-vendor', 'guard_name' => 'admin']);

        Permission::create(['name' => 'Create-Category', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Read-Categories', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Update-Category', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Delete-Category', 'guard_name' => 'admin']);


        Permission::create(['name' => 'Create-SupCategory', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Read-SupCategories', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Update-SupCategory', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Delete-SupCategory', 'guard_name' => 'admin']);


        Permission::create(['name' => 'Read-Products', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Delete-Product', 'guard_name' => 'admin']);
                // Permission::create(['name' => 'Create-Product', 'guard_name' => 'admin']);
                        // Permission::create(['name' => 'Update-Product', 'guard_name' => 'admin']);








        //************************vendor PERMISSIONS ************************
        // Permission::create(['name' => 'Create-', 'guard_name' => 'vendor']);
        // Permission::create(['name' => 'Read-', 'guard_name' => 'vendor']);
        // Permission::create(['name' => 'Update-', 'guard_name' => 'vendor']);
        // Permission::create(['name' => 'Delete-', 'guard_name' => 'vendor']);


        // Permission::create(['name' => 'Create-City', 'guard_name' => 'vendor']);
        Permission::create(['name' => 'Read-Cities', 'guard_name' => 'vendor']);
        // Permission::create(['name' => 'Update-City', 'guard_name' => 'vendor']);
        // Permission::create(['name' => 'Delete-City', 'guard_name' => 'vendor']);

        Permission::create(['name' => 'Create-Product', 'guard_name' => 'vendor']);
        Permission::create(['name' => 'Read-Products', 'guard_name' => 'vendor']);
        Permission::create(['name' => 'Update-Product', 'guard_name' => 'vendor']);
        Permission::create(['name' => 'Delete-Product', 'guard_name' => 'vendor']);

        Permission::create(['name' => 'Read-Categories', 'guard_name' => 'vendor']);
        Permission::create(['name' => 'Read-SupCategories', 'guard_name' => 'vendor']);

        // Permission::create(['name' => 'Read-vendors', 'guard_name' => 'vendor']);
        // Permission::create(['name' => 'Read-Users', 'guard_name' => 'vendor']);


        Permission::create(['name' => 'Read-Categories', 'guard_name' => 'user']);
        Permission::create(['name' => 'Read-SupCategories', 'guard_name' => 'user']); 

      

    }
}
