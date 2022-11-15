<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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
 * GET             users/register.blade.php ........ users.register.blade.php › UserController@register.blade.php
 * GET             users/{user} ........ users.show › UserController@show
 * PUT             users/{user} ........ users.update › UserController@update
 * DELETE          users/{user} ........ users.destroy › UserController@destroy
 * GET             users/{user}/edit ... users.edit › UserController@edit
 */

Route::view('/','landing')->name('landing');

Route::view('/register', 'user.register')->name('register');
Route::post('/register', [UserController::class, 'create'])->name('users.create');

Route::view('/login', 'user.login')->name('login');
Route::post('/login', [UserController::class, 'authenticate'])->name('authenticate');

Route::get('/logout', [UserController::class, 'logout'])->name('logout');

Route::get('/user/{id}/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');

//Route::resource('/users', UserController::class);
