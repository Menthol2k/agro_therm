<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Administration\Users\Edit;
use App\Http\Controllers\Administration\Users\Index;
use App\Http\Controllers\Administration\Users\Store;
use App\Http\Controllers\Administration\Users\Create;
use App\Http\Controllers\Administration\Users\Update;

Route::middleware(['auth'])
    ->group(function () {
        Route::namespace('')
            ->prefix('administration/users')
            ->as('administration.users.')
            ->group(function () {
                Route::get('', Index::class)->middleware('can:view users');
                Route::get('create', Create::class)->middleware('can:create user');
                Route::post('store', Store::class)->middleware('can:create user');
                Route::get('{user}/edit', Edit::class)->middleware('can:edit user');
                Route::put('{user}/update', Update::class)->middleware('can:edit user');
            });
    });
