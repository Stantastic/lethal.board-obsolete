<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        Permission::create(['name' => 'acp-access']);
        Permission::create(['name' => 'acp-edit-node']);


        // Create the default root and user role
        Role::create(['name' => 'default']);

        $root = Role::create(['name' => 'root']);
        $root->givePermissionTo(Permission::all());
    }
}
