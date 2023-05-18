<?php

namespace App\Http\Controllers\Administration\Users;

use Inertia\Inertia;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;

class Create extends Controller
{
    public function __invoke()
    {
        return Inertia::render('Administration/Users/Create', [
            'roles' => Role::all(),
            'role_id' => null
        ]);
    }
}
