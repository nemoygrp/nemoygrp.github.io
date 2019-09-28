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

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', 'IndexController@index')->name('index');

Route::get('vacation/{id}', 'VacationController@one')->name('vacationOne');

Route::get('add/{id}', 'VacationController@add')->name('vacationAdd');
Route::post('add', 'VacationController@save')->name('vacationSave');

Route::get('edit/{id}/{id_user}', 'VacationController@edit')->name('vacationEdit');


Route::get('delete/{id}', 'VacationController@delete')->name('vacationDelete');

Route::get('accepted/{id}', 'VacationController@accepted')->name('vacationAccepted');
