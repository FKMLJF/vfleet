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
    return view('layout');
});

Route::post('log-in', 'UserController@login')->name('log-in');

Route::post('/logout', 'UserController@logout')->name('logout');

Route::post('/check', 'UserController@check')->name('check');




Route::middleware(['auth'])->group(function () {
    Route::as('home.')
        ->prefix('home')
        ->group(function () {
            Route::post('/index', 'HomeController@index')->name('index');

            Route::post('/profil', 'HomeController@profil')->name('profil');
        });

    Route::as('car.')
        ->prefix('car')
        ->group(function () {
            Route::post('/documents', 'CarController@documents')->name('documents');

            Route::post('/carinfo', 'CarController@carinfo')->name('carinfo');

            Route::post('/carselect', 'CarController@carselect')->name('carselect');

            Route::post('/setcarselect', 'CarController@setcarselect')->name('setcarselect');

        });


    Route::as('fuel.')
        ->prefix('fuel')
        ->group(function () {
            Route::post('/index', 'FuelController@index')->name('index');
            Route::post('/postfuel', 'FuelController@postfuel')->name('postfuel');
        });

    Route::as('service.')
        ->prefix('service')
        ->group(function () {
            Route::post('/index', 'ServiceController@index')->name('index');

            Route::post('/postservice', 'ServiceController@postservice')->name('postservice');
        });
});

Auth::routes();


