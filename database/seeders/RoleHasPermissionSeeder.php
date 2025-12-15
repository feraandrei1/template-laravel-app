<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;

use Illuminate\Database\Seeder;

class RoleHasPermissionSeeder extends Seeder
{
    /**P
     * Run the database seeds.
     */
    public function run(): void
    {
        // Declaring the variables for the main roles
        $adminRole = Role::findByName('Super Admin');

        // Fetching all permissions
        $permissions = Permission::all();

        // Assigning all permissions to Super Admin
        foreach ($permissions as $permission) {
            $adminRole->givePermissionTo($permission);
        }
    }
}
