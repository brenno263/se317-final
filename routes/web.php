<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ImageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now register.blade.php something great!
|
*/

/*
 * Resource routes provide some basic routes for a REST resource.
 * Here is an example for Route::resource('/users'. UserController::class);
 *
 * GET             users ............... users.index › UserController@index
 * POST            users ............... users.store › UserController@store
 * GET             users/{users} ........ users.show › UserController@show
 * PUT             users/{users} ........ users.update › UserController@update
 * DELETE          users/{users} ........ users.destroy › UserController@destroy
 * GET             users/{users}/edit ... users.edit › UserController@edit
 */

Route::view('/','landing')->name('landing');

Route::view('/register', 'users.register')->name('register');
Route::post('/register', [UserController::class, 'create'])->name('users.create');

Route::view('/login', 'users.login')->name('login');
Route::post('/login', [UserController::class, 'authenticate'])->name('authenticate');

Route::get('/logout', [UserController::class, 'logout'])->name('logout');

//These routes require authorization to access
Route::middleware(['auth'])->group(function() {
    //View the current user's dashboard or images
    Route::get('/dashboard', DashboardController::class)->name('dashboard');
    Route::resource('images', ImageController::class)->scoped();
});




//Route::resource('/userss', UserController::class);
