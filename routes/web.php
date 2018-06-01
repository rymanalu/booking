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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::prefix('profile')->group(function () {
    Route::get('/', 'ProfileController@index')->name('profile.index');
    Route::post('/', 'ProfileController@update')->name('profile.update');
});

Route::resources([
    'admins' => 'AdminsController',
    'schedules' => 'SchedulesController',
    'users' => 'UsersController',
]);
