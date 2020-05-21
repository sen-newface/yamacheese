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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/events', 'EventController@index')->name('events.index');
    Route::get('/events/create', 'EventController@create')->name('events.create');
    Route::post('/events', 'EventController@store')->name('events.store');

    Route::get('/events/{event}/edit', 'EventController@edit')->name('events.edit');
    Route::put('/events/{event}/edit', 'EventController@update')->name('events.update');
});
