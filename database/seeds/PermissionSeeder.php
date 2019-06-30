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

        // ACP
        Permission::create(['name' => 'acp-access']);
        Permission::create(['name' => 'acp-edit-settings']);
        Permission::create(['name' => 'acp-edit-nodes']);
        Permission::create(['name' => 'acp-edit-users']);
        Permission::create(['name' => 'acp-edit-roles']);
        Permission::create(['name' => 'acp-edit-gameservers']);
        Permission::create(['name' => 'acp-edit-widgets']);
        Permission::create(['name' => 'acp-edit-pages']);
        Permission::create(['name' => 'acp-edit-communication']);



        // Create Default Roles
        Role::create(['name' => 'default']);

        $root = Role::create(['name' => 'root']);
        $root->givePermissionTo(Permission::all());
    }
}
