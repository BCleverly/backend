<?php

namespace BCleverly\Backend\Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class PermissionRoleSeeder extends Seeder
{
    protected array $roles = [
        'SuperAdmin',
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
    }
}
