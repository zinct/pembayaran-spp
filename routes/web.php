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

        Route::get('/kelas', 'KelasController@index')->name('kelas.index');
        Route::post('/kelas', 'KelasController@store')->name('kelas.store');
        Route::get('/kelas/data/{kelas}', 'KelasController@find')->name('kelas.find');
        Route::patch('/kelas/{kelas}', 'KelasController@update')->name('kelas.update');
        Route::delete('/kelas/{kelas}', 'KelasController@destroy')->name('kelas.destroy');

        Route::get('/kompetensi', 'KompetensiController@index')->name('kompetensi.index');
        Route::post('/kompetensi', 'KompetensiController@store')->name('kompetensi.store');
        Route::get('/kompetensi/data/{kompetensi}', 'KompetensiController@find')->name('kompetensi.find');
        Route::patch('/kompetensi/{kompetensi}', 'KompetensiController@update')->name('kompetensi.update');
        Route::delete('/kompetensi/{kompetensi}', 'KompetensiController@destroy')->name('kompetensi.destroy');

        Route::get('/tahun', 'TahunController@index')->name('tahun.index');
        Route::post('/tahun', 'TahunController@store')->name('tahun.store');
        Route::get('/tahun/data/{tahun}', 'TahunController@find')->name('tahun.find');
        Route::patch('/tahun/{tahun}', 'TahunController@update')->name('tahun.update');
        Route::delete('/tahun/{tahun}', 'TahunController@destroy')->name('tahun.destroy');

    });
});
