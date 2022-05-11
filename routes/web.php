<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\PointerController;

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
    return view('welcome');
});

Route::get('auth/google', [GoogleController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', [PointerController::class, 'dashboard'])->name('dashboard');
});

Route::resource('/pointer', PointerController::class)->middleware('auth:sanctum');

Route::fallback(function () {
    return view('404');
});

Route::middleware(['auth:sanctum', 'role:admin'])->group(function(){
    Route::get('/addadmin/{id}', function ($id) {
        $user = User::find($id);
        $user->roles()->attach('1');
    });

    Route::get('/removeadmin/{id}', function ($id) {
        $user = User::find($id);
        $user->roles()->attach('1');
    });
});
