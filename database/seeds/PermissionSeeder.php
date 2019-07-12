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

        // ACP Permissions
        Permission::create(['name' => 'acp-access']);
        Permission::create(['name' => 'acp-edit-settings']);
        Permission::create(['name' => 'acp-edit-nodes']);
        Permission::create(['name' => 'acp-edit-users']);
        Permission::create(['name' => 'acp-edit-roles']);
        Permission::create(['name' => 'acp-edit-gameservers']);
        Permission::create(['name' => 'acp-edit-widgets']);
        Permission::create(['name' => 'acp-edit-pages']);
        Permission::create(['name' => 'acp-edit-communication']);

        // Moderation Permissions
        Permission::create(['name' => 'mod-topic-edit']);
        Permission::create(['name' => 'mod-topic-delete']);
        Permission::create(['name' => 'mod-topic-lock']);
        Permission::create(['name' => 'mod-ban-user']);
        Permission::create(['name' => 'mod-topic-move']);
        Permission::create(['name' => 'mod-topic-stick']);
        Permission::create(['name' => 'mod-post-delete']);
        Permission::create(['name' => 'mod-post-edit']);
        Permission::create(['name' => 'mod-user-edit']);

        // User Permissions
        Permission::create(['name' => 'create-topic']);
        Permission::create(['name' => 'create-post']);
        Permission::create(['name' => 'topic-prefix']);


        // Create Default Roles
        Role::create(['name' => 'default', 'display_name'=>'User']);

        $root = Role::create(['name' => 'root', 'display_name'=>'Admin', 'is_team'=> 1]);
        $root->givePermissionTo(Permission::all());
    }
}
