<?php

namespace App\Http\Controllers\Administration\Users;

use App\Models\User;
use Inertia\Inertia;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;

class Edit extends Controller
{
    public function __invoke(User $user)
    {
        return Inertia::render('Administration/Users/Edit', [
            'roles' => Role::all(),
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phone,
                'obs' => $user->obs,
                'role_id' => optional($user->roles->first())->id
            ],
        ]);
    }
}
