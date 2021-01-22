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

Route::get('/', function () {
    return view('welcome');
});

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

//    Route::get('students/', 'Admin\StudentController@index')->name('students');
//    Route::get('students/create', 'Admin\StudentController@create')->name('students.create');
//    Route::get('students/{id}/edit', 'Admin\StudentController@edit')->where('id', '[0-9]+')->name('students.edit');
//    Route::get('students/{id}/delete', 'Admin\StudentController@delete')->where('id', '[0-9]+')->name('students.delete');
//
//    Route::post('students', 'Admin\StudentController@store')->name('students.store');
//    Route::post('students/{id}', 'Admin\StudentController@update')->where('id', '[0-9]+')->name('students.update');
//    Route::post('students/{id}/delete', 'Admin\StudentController@destroy')->where('id', '[0-9]+')->name('students.destroy');

});
