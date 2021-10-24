<?php

namespace BCleverly\Backend\Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionRoleSeeder extends Seeder
{
    protected array $roles = [
        'SuperAdmin',
        'Admin',
        'Editor',
        'Publisher',
    ];

    protected array $permissions = [
        'browse',
        'create',
        'read',
        'update',
        'delete',
    ];

    public function run()
    {
        foreach ($this->roles as $role) {
            Role::create(['name' => $role]);
        }
        foreach ($this->permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
