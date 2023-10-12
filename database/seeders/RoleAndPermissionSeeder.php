<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{

    public function run()
    {
        Permission::create(['name' => 'edit tickets']);
        Permission::create(['name' => 'delete tickets']);

        Role::create(['name' => 'Admin'])->givePermissionTo(['edit tickets', 'delete tickets']);
        Role::create(['name' => 'Agent'])->givePermissionTo('edit tickets');

    }
}
