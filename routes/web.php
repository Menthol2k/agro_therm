<?php

use Inertia\Inertia;
use App\Http\Controllers\Dashboard;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    // if (auth()->user()) {
    //     return redirect(auth()->user()->role->menu);
    // }

    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->middleware('auth');

Route::get('/', Dashboard::class)->middleware(['auth', 'verified', 'can:view dashboard']);
Route::get('/dashboard', Dashboard::class)->middleware(['auth', 'verified', 'can:view dashboard'])->name('dashboard');

require __DIR__.'/auth.php';
require __DIR__.'/app/users.php';
