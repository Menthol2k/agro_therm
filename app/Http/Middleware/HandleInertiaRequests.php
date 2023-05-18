<?php

namespace App\Http\Middleware;

use Inertia\Middleware;
use Tightenco\Ziggy\Ziggy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request)
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function share(Request $request)
    {
        $user = $request->user();
        return array_merge(parent::share($request), [
            'auth' => [
                'user' => $user,
                'permissions' => $user ? $user->permissionList() : [],
                'can' => [
                    'viewDashboard' => Auth::user() ? Auth::user()->can('view dashboard') : false,
                    'viewAdministration' => Auth::user() ? Auth::user()->can('view administration') : false,
                    'viewUsers' => Auth::user() ? Auth::user()->can('view users') : false,
                ],
            ],
            'ziggy' => function () {
                return (new Ziggy)->toArray();
            },
            'toast' => function () {
                return [
                    'error' => Session::get('error'),
                    'success' => Session::get('success'),
                ];
            },
            'popstate' => false,
        ]);
    }
}
