<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
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

        if(Auth::id() != $id){
            $user = User::find($id);
            // Est-ce que l'utilisateur existe
            if( !empty($user) ){
                // Il existe, est-ce que l'utilisateur n'est pas déjà admin ?
                if( empty($user->roles()->where('role_id', '1')->first()) ){
                    $user->roles()->attach('1');
                    return redirect()->route('dashboard')->with('message', "$user->prenom est maintenant administrateur");
                }
                else{
                    // L'utilisateur était déjà admin
                    return redirect()->route('dashboard')->with('message', "$user->prenom est déjà un administrateur");
                }

            }
            else{
                // L'utilisateur n'existe pas
                return redirect()->back()->with('message', "L'utilisateur n'existe pas");
            }

        }
        else{
            return redirect()->route('dashboard')->with('message', 'Vous ne pouvez pas toucher à vos propres permissions');
        }
    });

    Route::get('/removeadmin/{id}', function ($id) {

        if(Auth::id() != $id){
            $user = User::find($id);
            // Est-ce que l'utilisateur existe
            if( !empty($user) ){
                // Il existe, est-ce que l'utilisateur est admin ?
                if( !empty($user->roles()->where('role_id', '1')->first()) ){
                    $user->roles()->detach('1');
                    return redirect()->route('dashboard')->with('message', "$user->prenom n'est plus administrateur");
                }
                else{
                    // L'utilisateur n'est pas admin
                    return redirect()->route('dashboard')->with('message', "$user->prenom n'est déjà pas un administrateur");
                }

            }
            else{
                // L'utilisateur n'existe pas
                return redirect()->back()->with('message', "L'utilisateur n'existe pas");
            }

        }
        else{
            return redirect()->route('dashboard')->with('message', 'Vous ne pouvez pas toucher à vos propres permissions');
        }
        
    });
});

Route::get('/testmail', [PointerController::class, "welcome"]);