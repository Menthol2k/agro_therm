<?php

namespace App\Http\Controllers\Administration\Users;

use App\Models\User;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Redirect;

class Store extends Controller
{
    public function __invoke()
    {
        Request::validate([
            'name' => ['required', 'max:50'],
            'email' => ['required', 'max:50', Rule::unique('users'),'email:rfc,dns'],
            'phone' => ['nullable'],
            'obs' => ['nullable'],
        ], [
            'branch_id.required_if' => __('The field is required when the role is user'),
            'areaIds.required_with' => __('The field is required when the branch field is populated')
        ]);

        $user =  User::create([
            'name' => Request::get('name'),
            'email' => Request::get('email'),
            'phone'=> Request::get('phone'),
            'password' => Hash::make('123456'),
            'obs'=> Request::get('obs'),
        ]);

        if (request()->get('role_id')) {
            $user->assignRole(Role::find(request()->get('role_id'))->name);
        }


        return Redirect::to('/administration/users')->with(['success'=> ['message'=> 'Utilizatorul a fost creat cu succes!']]);
    }
}
