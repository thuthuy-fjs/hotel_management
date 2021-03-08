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
Route::get('logout', 'Auth\Frontend\LoginController@logout')->name('logout');
Route::get('forgot-password', 'Auth\Frontend\ForgotPasswordController@getEmail')->name('forgot-password.getEmail');
Route::post('forgot-password/send', 'Auth\Frontend\ForgotPasswordController@sendEmail')->name('forgot-password.sendEmail');
Route::get('forgot-password/token={token}', 'Auth\Frontend\ForgotPasswordController@getReset')->name('forgot-password');
Route::post('forgot-password/update/{token}', 'Auth\Frontend\ForgotPasswordController@resetPassword')->name('forgot-password.update');

Route::get('auth/{provider}', 'Auth\Frontend\LoginController@redirectToProvider')->name('provider');
Route::get('auth/{provider}/callback', 'Auth\Frontend\LoginController@handleProviderCallback')->name('provider.callback');

Route::get('profile', 'Frontend\GuestManagerController@show')->name('profile');
Route::get('profile/edit', 'Frontend\GuestManagerController@edit')->name('profile.edit');
Route::post('profile/update', 'Frontend\GuestManagerController@update')->name('profile.update');
Route::post('change-password/update', 'Frontend\GuestManagerController@updatePassword')->name('change-password.update');

Route::get('provinces', 'Frontend\ProvinceController@index')->name('province');

Route::get('search/', 'Frontend\HomePageController@search')->name('search');
Route::get('search/country/{id}', 'Frontend\SearchController@searchByCountry')->name('search.country');
Route::get('search/province/{id}', 'Frontend\SearchController@searchByProvince')->name('search.province');
Route::get('search/category/{id}', 'Frontend\SearchController@searchByCategory')->name('search.category');

Route::get('hotel', 'Frontend\HotelController@hotel')->name('hotel');

Route::get('booking', 'Frontend\HotelController@booking')->name('booking')->middleware('web');
Route::post('booking/store', 'Frontend\BookingController@store')->name('booking.store');

Route::get('comment', 'Frontend\StarRatingController@comment')->name('comment');

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
    Route::get('forgot-password', 'Auth\Admin\ForgotPasswordController@getEmail')->name('forgot-password.getEmail');
    Route::post('forgot-password/send', 'Auth\Admin\ForgotPasswordController@sendEmail')->name('forgot-password.sendEmail');
    Route::get('forgot-password/token={token}', 'Auth\Admin\ForgotPasswordController@getReset')->name('forgot-password');
    Route::post('forgot-password/update/{token}', 'Auth\Admin\ForgotPasswordController@resetPassword')->name('forgot-password.update');
    Route::get('change-password', 'Auth\Admin\ResetPasswordController@index')->name('change-password');
    Route::post('change-password/update', 'Auth\Admin\ResetPasswordController@update')->name('change-password.update');

    Route::get('auth/{provider}', 'Auth\Admin\LoginController@redirectToProvider')->name('provider');
    Route::get('auth/{provider}/callback', 'Auth\Admin\LoginController@handleProviderCallback')->name('provider.callback');

    Route::get('profile', 'Admin\AdminManagerController@show')->name('profile');
    Route::get('profile/edit', 'Admin\AdminManagerController@edit')->name('profile.edit');
    Route::post('profile/update', 'Admin\AdminManagerController@update')->name('profile.update');

    Route::get('country', 'Admin\CountryController@index')->name('country');
    Route::get('county/create', 'Admin\CountryController@create')->name('country.create');
    Route::post('country', 'Admin\CountryController@store')->name('country.store');

    Route::get('province', 'Admin\ProvinceController@index')->name('province');
    Route::get('province/create', 'Admin\ProvinceController@create')->name('province.create');
    Route::post('province', 'Admin\ProvinceController@store')->name('province.store');

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
    Route::get('room/export', 'Admin\RoomController@export')->name('room.export');

    Route::post('room', 'Admin\RoomController@store')->name('room.store');
    Route::post('room/{id}', 'Admin\RoomController@update')->where('id', '[0-9]+')->name('room.update');
    Route::post('room/delete/{id}', 'Admin\RoomController@destroy')->where('id', '[0-9]+')->name('room.destroy');
    Route::post('room/import', 'Admin\RoomController@import')->name('room.import');

    Route::get('room/facility/create', 'Admin\RoomFacilityController@create')->name('room.facility.create');
    Route::post('room/facility', 'Admin\RoomFacilityController@store')->name('room.facility.store');

    Route::get('room/detail', 'Admin\RoomDetailController@index')->name('room.detail');
    Route::get('room/list_hotels', 'Admin\RoomDetailController@getHotels')->name('room.list_hotels');
    Route::get('room/calendar', 'Admin\RoomDetailController@getRooms')->name('room.calendar');

    Route::get('guest', 'Admin\GuestController@index')->name('guest');
    Route::get('guest/create', 'Admin\GuestController@create')->name('guest.create');
    Route::get('guest/edit/{id}', 'Admin\GuestController@edit')->name('guest.edit');
    Route::get('guest/export', 'Admin\GuestController@export')->name('guest.export');;

    Route::post('guest', 'Admin\GuestController@store')->name('guest.store');
    Route::post('guest/{id}', 'Admin\GuestController@update')->name('guest.update');
    Route::post('guest/delete/{id}', 'Admin\GuestController@destroy')->where('id', '[0-9]+')->name('guest.destroy');
    Route::post('guest/import', 'Admin\GuestController@import')->name('guest.import');


    Route::get('booking', 'Admin\BookingManagerController@index')->name('booking');;

});
