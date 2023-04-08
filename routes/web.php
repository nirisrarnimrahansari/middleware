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
route::resource('/register','App\Http\Controllers\UserController')->middleware('AlreadyLoggedIn');;
route::get('/login','App\Http\Controllers\UserController@login')->middleware('AlreadyLoggedIn');
route::post('/login','App\Http\Controllers\UserController@loginUser')->name('loginuser')->middleware('AlreadyLoggedIn');
route::get('/dashboard','App\Http\Controllers\UserController@dashboard')->middleware('isloggedin');
route::get('/userDashboard','App\Http\Controllers\UserController@userDashboard')->middleware('userAuth');
route::get('/logout','App\Http\Controllers\UserController@logout')->name('logout');
Route::post('/search','App\Http\Controllers\UserController@search')->name('search');
Route::post('/showas', 'App\Http\Controllers\UserController@showas');


// Route::view('/demo','demo'); 
// Route::redirect('/demo','/login');
// Route::get($uri,$callback); 
// Route::get('/', function () {
//     return view('demo');
// });
// route::get('/demo/{id?}', function($id){
//     return view('demo');
// });
// Route::get('/demo/{name?}', function ($name = null) {
//     return $name;
// });
// Route::get('user/{name?}', function ($name = 'John') {
//     return $name;
// });