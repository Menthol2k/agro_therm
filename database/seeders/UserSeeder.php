<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        collect([
            ['name' => 'Ionut', 'email' => 'ionut@twm.ro', 'password' => 'twm2022','is_admin'=>true,'role_id'=>1],
            ['name' => 'Marian', 'email' => 'marian@twm.ro', 'password' => 'twm2022','is_admin'=>true,'role_id'=>1],
            ['name' => 'Florin', 'email' => 'florin@twm.ro', 'password' => 'twm2022','is_admin'=>true,'role_id'=>1],
            ['name' => 'Ionel', 'email' => 'ionel@twm.ro', 'password' => 'twm2022','is_admin'=>true,'role_id'=>1],
            ['name' => 'Adrian', 'email' => 'adrian@twm.ro', 'password' => 'basa','is_admin'=>true,'role_id'=>1],
            ['name' => 'Diana', 'email' => 'diana@twm.ro', 'password' => 'twm2022','is_admin'=>true,'role_id'=>1],
        ])->each(function ($factory) {
            $user = User::factory()->make([
                'name' => $factory['name'],
                'email' => $factory['email'],
                // 'role_id' => $factory['role_id']
            ]);

            $user->password = Hash::make($factory['password']);

            $user->save();

            $user->assignRole(Role::first());
        });
    }
}
