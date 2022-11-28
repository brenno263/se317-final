<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\LandingController;

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
 * Here is an example for Route::resource('/images'. ImageController::class);
 *
 * GET             images ................ images.index › ImageController@index
 * POST            images ................ images.store › ImageController@store
 * GET             images/{image} ........ images.show › ImageController@show
 * PUT             images/{image} ........ images.update › ImageController@update
 * DELETE          images/{image} ........ images.destroy › ImageController@destroy
 * GET             images/{image}/edit ... images.edit › ImageController@edit
 */

// Our landing page gets its own controller. This is what all users are shown upon first visiting the site. It's a collection of tiles of recent, public images.
Route::get('/', LandingController::class)->name('landing');

// Show the page with our registration form. The view() method returns a blade view directly, for things that are simple enough to not need a controller action.
Route::view('/register', 'users.register')->name('register');
// Accept data from the registration form, registering a new user.
Route::post('/register', [UserController::class, 'create'])->name('users.create');

// Show tha page with our login form.
Route::view('/login', 'users.login')->name('login');
// Accept data from the login form, logging in the user and redirecting to their intended destination if we tried to access a route protected by the 'auth' middleware.
Route::post('/login', [UserController::class, 'authenticate'])->name('authenticate');

// Log the user out and redirect to the landing page.
Route::get('/logout', [UserController::class, 'logout'])->name('logout');

// Show an index of ALL publicly available images.
Route::get('/images', [ImageController::class, 'publicIndex'])->name('images.public-index');
// Register all standard resource routes for Images. (see above for an example).
// scoped->() simply adds a middleware that ensures for any route /users/{user}/images/{image}/... that the image in the route must belong to the user in the route.
Route::resource('users.images', ImageController::class)->scoped();
// A deleting-confirmation page is not included in standard resource routes. Here, we add our own.
Route::get('/users/{user}/images/{image}/destroy-confirm', [ImageController::class, 'destroyConfirm'])->name('users.images.destroy-confirm');
