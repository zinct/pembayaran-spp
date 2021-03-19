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
    echo 'Hello World';
});

Route::namespace('Admin')->prefix('admin')->name('admin.')->group(function() {

    Route::namespace('Data')->prefix('data')->name('data.')->group(function() { // Master Data      
        
        Route::get('/siswa', 'SiswaController@index')->name('siswa.index');
        Route::post('/siswa', 'SiswaController@store')->name('siswa.store');
        Route::get('/siswa/create', 'SiswaController@create')->name('siswa.create');
        Route::get('/siswa/edit/{siswa}', 'SiswaController@edit')->name('siswa.edit');
        Route::get('/siswa/data/{siswa}', 'SiswaController@find')->name('siswa.find');
        Route::patch('/siswa/{siswa}', 'SiswaController@update')->name('siswa.update');
        Route::delete('/siswa/{siswa}', 'SiswaController@destroy')->name('siswa.destroy');

    });
});
