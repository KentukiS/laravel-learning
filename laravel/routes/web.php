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
// Task 1: point the main "/" URL to the HomeController method "index"
Route::get('/', 'App\Http\Controllers\HomeController@index');
//Task 2: point the GET URL "/user/[name]" to the UserController method "show"
Route::get('/user/{name}', 'App\Http\Controllers\UserController@show');
// Task 3: point the GET URL "/about" to the view
// resources/views/pages/about.blade.php - without any controller
// Also, assign the route name "about"
// Put one code line here below
Route::view('/about', 'pages.about');
