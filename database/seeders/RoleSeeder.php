<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    public function run()
    {
        collect([
            ['name' => 'view dashboard'],
            ['name' => 'view administration'],
            ['name' => 'view users'],
            ['name' => 'create user'],
            ['name' => 'edit user'],
        ])->each(function ($factory) {
            Permission::create($factory);
        });
        
        collect(['admin'])->each(function ($factory) {
            $role = Role::create(['name' => $factory]);
            $role->syncPermissions(Permission::all());
        });
    }
}
