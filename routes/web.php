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
    return redirect()->route('login');
});

Route::namespace('Auth')->group(function() {

    Route::middleware(['guest'])->group(function() {
        Route::get('/login', 'AuthController@index')->name('login');
        Route::post('/login', 'AuthController@login');
    });

    Route::get('/logout', 'AuthController@logout')->name('logout');

});

