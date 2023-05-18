<?php

namespace App\Http\Controllers\Administration\Users;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class Index extends Controller
{
    public function __invoke()
    {
        request()->validate([
            'direction' => ['in:asc,desc'],
            'field' => ['in:name,email,phone,obs,role_id,branchName'],
            'perPage' => [ Rule::in([10, 15, 25]) ]
        ]);

        $perPage = (request('perPage') ? request('perPage') : 15);

        $query = User::with('roles')->selectRaw('
            users.id, users.name, users.email, users.phone, users.obs, roles.name as role
        ')->leftJoin('model_has_roles', 'model_has_roles.model_id', 'users.id')
            ->leftJoin('roles', 'roles.id', 'model_has_roles.role_id');

        if (request('search')) {
            $query->where(function ($query) {
                $query->where('email', 'LIKE', "%".request('search').'%');
                $query->orwhere('users.name', 'LIKE', '%'.request('search').'%');
                $query->orwhere('phone', 'LIKE', '%'.request('search').'%');
                $query->orwhere('users.obs', 'LIKE', '%'.request('search').'%');
            });
        }

        if (request()->has(['field', 'direction'])) {
            $query->orderBy(request('field'), request('direction'));
        } else {
            $query->orderBy('users.id', 'Desc');
        }
        
        return Inertia::render('Administration/Users/Index', [
            'can' => [
                'viewIndex' => Auth::user()->can('view users'),
                'create' => Auth::user()->can('create user'),
                'edit' => Auth::user()->can('edit user'),
            ],
            'users' => $query->paginate($perPage)->withQueryString(),
            'filters' => request()->all(['search', 'field', 'direction']),
            'perPage' => intval($perPage)
        ]);
    }
}
