<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/redirect', '\App\Http\Controllers\Auth\LoginController@redirectToProvider')->name('login');
Route::get('/callback', '\App\Http\Controllers\Auth\LoginController@handleProviderCallback');

Route::group(['middleware' => ['auth']], function() {
    Route::get('/home', '\App\Http\Controllers\UserController@home');
    Route::get('/logout', '\App\Http\Controllers\Auth\LogoutController@logout');

    Route::middleware(['admin'])->group(function() {
        Route::get('/dashboard', '\App\Http\Controllers\AdminController@dashboard');
        Route::get('/all-users', '\App\Http\Controllers\AdminController@allUsers');
        Route::get('/all-logins', '\App\Http\Controllers\AdminController@allLogins');
    });
});
