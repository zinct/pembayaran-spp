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

Route::namespace('Admin')->middleware('auth:admin')->prefix('admin')->name('admin.')->group(function() {

    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

    Route::namespace('UserManager')->prefix('user-manager')->name('user-manager.')->group(function() {
        
        Route::middleware('can:user-manager.user')->group(function() {
            Route::get('/user', 'UserController@index')->name('user.index');
            Route::post('/user', 'UserController@store')->name('user.store');
            Route::get('/user/data/{user}', 'UserController@find')->name('user.find');
            Route::patch('/user/{user}', 'UserController@update')->name('user.update');
            Route::delete('/user/{user}', 'UserController@destroy')->name('user.destroy');
        });

        Route::middleware('can:user-manager.role')->group(function() {
            Route::get('/role', 'RoleController@index')->name('role.index');
            Route::post('/role', 'RoleController@store')->name('role.store');
            Route::get('/role/edit/{role}', 'RoleController@edit')->name('role.edit');
            Route::patch('/role/{role}', 'RoleController@update')->name('role.update');
            Route::delete('/role/{role}', 'RoleController@destroy')->name('role.destroy');
        });

        Route::middleware('can:user-manager.permission')->group(function() {
            Route::get('/permission', 'PermissionController@index')->name('permission.index');
            Route::post('/permission', 'PermissionController@store')->name('permission.store');
            Route::get('/permission/data/{permission}', 'PermissionController@find')->name('permission.find');
            Route::patch('/permission/{permission}', 'PermissionController@update')->name('permission.update');
            Route::delete('/permission/{permission}', 'PermissionController@destroy')->name('permission.destroy');
        });
        
        Route::get('/profile', 'ProfileController@index')->name('profile.index');
        Route::post('/profile/{user}', 'ProfileController@update')->name('profile.update');
        Route::get('/profile/delete-avatar', 'ProfileController@deleteAvatar')->name('profile.delete-avatar');

    });

});

