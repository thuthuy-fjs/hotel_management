<?php

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


Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth:admin']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

/**
 * Homepage route
 */

Route::get('/', 'Frontend\HomepageController@index')->name('home');
Route::get('login', 'Auth\Frontend\LoginController@login')->name('login');
Route::post('login', 'Auth\Frontend\LoginController@store')->name('login.store');
Route::get('register', 'Auth\Frontend\RegisterController@create')->name('register');
Route::post('register', 'Auth\Frontend\RegisterController@store')->name('register.store');

/**
 * Admin route
 */

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/', 'AdminController@index')->name('dashboard');
    Route::get('/dashboard', 'AdminController@index')->name('dashboard');

    Route::get('register', 'Auth\Admin\RegisterController@create')->name('register');
    Route::post('register', 'Auth\Admin\RegisterController@store')->name('register.store');

    Route::get('login', 'Auth\Admin\LoginController@login')->name('auth.login');
    Route::post('login', 'Auth\Admin\LoginController@loginAdmin')->name('auth.loginAdmin');
    Route::get('logout', 'Auth\Admin\LoginController@logout')->name('auth.logout');

    Route::get('profile', 'Admin\AdminManagerController@show')->name('profile');
    Route::get('profile/edit', 'Admin\AdminManagerController@edit')->name('profile.edit');
    Route::post('profile/update', 'Admin\AdminManagerController@update')->name('profile.update');

    Route::get('country', 'Admin\CountryController@index')->name('country');
    Route::get('province', 'Admin\ProvinceController@index')->name('province');

    Route::get('hotel/', 'Admin\HotelController@index')->name('hotel');
    Route::get('hotel/list_provinces', 'Admin\HotelController@getProvinces')->name('hotel.list_provinces');
    Route::get('hotel/list_hotels', 'Admin\HotelController@getHotelInProvince')->name('hotel.list_hotels');
    Route::get('hotel/search', 'Admin\HotelController@search')->name('hotel.search');
    Route::get('hotel/create', 'Admin\HotelController@create')->name('hotel.create');
    Route::get('hotel/edit/{id}', 'Admin\HotelController@edit')->where('id', '[0-9]+')->name('hotel.edit');
    Route::get('hotel/export', 'Admin\HotelController@export')->name('hotel.export');;

    Route::post('hotel', 'Admin\HotelController@store')->name('hotel.store');
    Route::post('hotel/{id}', 'Admin\HotelController@update')->where('id', '[0-9]+')->name('hotel.update');
    Route::post('hotel/delete/{id}', 'Admin\HotelController@destroy')->where('id', '[0-9]+')->name('hotel.destroy');
    Route::post('hotel/import', 'Admin\HotelController@import')->name('hotel.import');

    Route::get('room/type', 'Admin\RoomTypeController@index')->name('room.type');

    Route::get('room/list', 'Admin\RoomController@index')->name('room.list');
    Route::get('room/show/{id}', 'Admin\RoomController@show')->name('room.show');
    Route::get('room/list_rooms', 'Admin\RoomController@getRoomInHotel')->name('room.list_rooms');
    Route::get('room/search', 'Admin\RoomController@search')->name('room.search');
    Route::get('room/create', 'Admin\RoomController@create')->name('room.create');
    Route::get('room/edit/{id}', 'Admin\RoomController@edit')->where('id', '[0-9]+')->name('room.edit');
    Route::get('room/export', 'Admin\RoomController@export')->name('room.export');;

    Route::post('room', 'Admin\RoomController@store')->name('room.store');
    Route::post('room/{id}', 'Admin\RoomController@update')->where('id', '[0-9]+')->name('room.update');
    Route::post('room/delete/{id}', 'Admin\RoomController@destroy')->where('id', '[0-9]+')->name('room.destroy');
    Route::post('room/import', 'Admin\RoomController@import')->name('room.import');

    Route::get('room/facility/create', 'Admin\RoomFacilityController@create')->name('room.facility.create');
    Route::post('room/facility', 'Admin\RoomFacilityController@store')->name('room.facility.store');
});
