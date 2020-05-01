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

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

Route::get('/', function () {
    return view('welcome');
})->middleware('userauth');


Route::get('/home', 'UserController@home')->middleware('userauth')->name('home');

Route::get('/fuel', function () {
    return view('fuel');
})->middleware('userauth')->name('fuel');

Route::get('/service', function () {
    return view('szerviz');
})->middleware('userauth')->name('service');

Route::get('/chart', function () {
    return view('chart');
})->middleware('userauth')->name('chart');

Route::get('/fuelcontent', function () {
    return view('fuelcontent');
})->middleware('userauth')->name('fuelcontent');

Route::post('/postfuel','UserController@postfuel')->middleware('userauth')->name('postfuel');

Route::post('/postservice','UserController@postservice')->middleware('userauth')->name('postservice');

Route::get('/login', function () {
    return view('login');
});


Route::post('postimage', function (Request $request) {
    $file = $request->file('img');
    $ex = explode('.',$file->getClientOriginalName());



    //  $request->file('img')->store('');
    $url =   Storage::disk('public')->putFile('', rename($request->file('img'), "bar.".$ex[count($ex)-1]));


})->name('postimage');

Route::get('/bar', function () {
    return view('bar');
});

Route::get('/logout', function (\Illuminate\Http\Request $r) {
    $r->session()->forget('userlogin');
    return view('login');
})->name('logout');

Route::post('allposts', 'UserController@allPosts' )->middleware('userauth')->name('allposts');
Route::post('allpostsservice', 'UserController@allPostsService' )->middleware('userauth')->name('allpostsservice');
Route::post('postchartdata', 'UserController@postchartdata' )->middleware('userauth')->name('postchartdata');
Route::get('datatable', 'UserController@datatable' )->middleware('userauth')->name('datatable');
Route::get('chart', 'UserController@chart' )->middleware('userauth')->name('chart');
Route::post('/auth', 'UserController@login')->name('login');


Route::as('home.')
    ->prefix('home')
    ->group(function () {
Route::post('/index', 'HomeController@index')->name('index');
        });
