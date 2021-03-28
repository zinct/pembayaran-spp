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

Route::namespace('Admin')->middleware('auth')->prefix('admin')->name('admin.')->group(function() {

    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

    Route::namespace('Data')->prefix('data')->name('data.')->group(function() {
        
        Route::middleware('can:data.siswa')->group(function() {
            Route::get('/siswa', 'SiswaController@index')->name('siswa.index');
            Route::post('/siswa', 'SiswaController@store')->name('siswa.store');
            Route::get('/siswa/create', 'SiswaController@create')->name('siswa.create');
            Route::get('/siswa/edit/{siswa}', 'SiswaController@edit')->name('siswa.edit');
            Route::get('/siswa/data/{siswa}', 'SiswaController@find')->name('siswa.find');
            Route::get('/siswa/{siswa}', 'SiswaController@show')->name('siswa.show');
            Route::patch('/siswa/{siswa}', 'SiswaController@update')->name('siswa.update');
            Route::delete('/siswa/{siswa}', 'SiswaController@destroy')->name('siswa.destroy');
        });

        Route::middleware('can:data.spp')->group(function() {
            Route::get('/spp', 'SppController@index')->name('spp.index');
            Route::post('/spp', 'SppController@store')->name('spp.store');
            Route::get('/spp/create', 'SppController@create')->name('spp.create');
            Route::get('/spp/edit/{spp}', 'SppController@edit')->name('spp.edit');
            Route::get('/spp/data/{spp}', 'SppController@find')->name('spp.find');
            Route::patch('/spp/{spp}', 'SppController@update')->name('spp.update');
            Route::delete('/spp/{spp}', 'SppController@destroy')->name('spp.destroy');
        });

        Route::middleware('can:data.kelas')->group(function() {
            Route::get('/kelas', 'KelasController@index')->name('kelas.index');
            Route::post('/kelas', 'KelasController@store')->name('kelas.store');
            Route::get('/kelas/data/{kelas}', 'KelasController@find')->name('kelas.find');
            Route::patch('/kelas/{kelas}', 'KelasController@update')->name('kelas.update');
            Route::delete('/kelas/{kelas}', 'KelasController@destroy')->name('kelas.destroy');
        });

        Route::middleware('can:data.kompetensi')->group(function() {
            Route::get('/kompetensi', 'KompetensiController@index')->name('kompetensi.index');
            Route::post('/kompetensi', 'KompetensiController@store')->name('kompetensi.store');
            Route::get('/kompetensi/data/{kompetensi}', 'KompetensiController@find')->name('kompetensi.find');
            Route::patch('/kompetensi/{kompetensi}', 'KompetensiController@update')->name('kompetensi.update');
            Route::delete('/kompetensi/{kompetensi}', 'KompetensiController@destroy')->name('kompetensi.destroy');
        });

        Route::middleware('can:data.tahun')->group(function() {
            Route::get('/tahun', 'TahunController@index')->name('tahun.index');
            Route::post('/tahun', 'TahunController@store')->name('tahun.store');
            Route::get('/tahun/data/{tahun}', 'TahunController@find')->name('tahun.find');
            Route::patch('/tahun/{tahun}', 'TahunController@update')->name('tahun.update');
            Route::delete('/tahun/{tahun}', 'TahunController@destroy')->name('tahun.destroy');
        });

    });

    Route::namespace('Transaksi')->prefix('transaksi')->name('transaksi.')->group(function() {

        Route::middleware('can:transaksi.tagihan')->group(function() {
            Route::get('/tagihan/data/{tagihan}', 'TagihanController@find')->name('tagihan.find');
            Route::post('/tagihan/{siswa}', 'TagihanController@store')->name('tagihan.store');
            Route::delete('/tagihan/{tagihan}/{siswa}', 'TagihanController@destroy')->name('tagihan.destroy');
        });

        Route::middleware('can:transaksi.pembayaran')->group(function() {
            Route::get('/pembayaran', 'PembayaranController@index')->name('pembayaran.index');
            Route::get('/pembayaran/create', 'PembayaranController@create')->name('pembayaran.create');
            Route::post('/pembayaran/{siswa}', 'PembayaranController@store')->name('pembayaran.store');
        });

    });

    Route::namespace('Laporan')->prefix('laporan')->name('laporan.')->group(function() {

        Route::get('/pembayaran', 'PembayaranController@index')->name('pembayaran.index');
        Route::get('/pembayaran/laporan', 'PembayaranController@laporan')->name('pembayaran.laporan');

    });

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
