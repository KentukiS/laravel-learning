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
// Task 4: redirect the GET URL "log-in" to a URL "login"
// Put one code line here below
Route::get('/log-in', function () {
    return redirect('/login');
});
// Task 5: group the following route sentences below in Route::group()
// Assign middleware "auth"
// Put one Route Group code line here below

// Tasks inside that Authenticated group:

// Task 6: /app group within a group
// Add another group for routes with prefix "app"
// Put one Route Group code line here below

// Tasks inside that /app group:


// Task 7: point URL /app/dashboard to a "Single Action" DashboardController
// Assign the route name "dashboard"
// Put one Route Group code line here below


// Task 8: Manage tasks with URL /app/tasks/***.
// Add ONE line to assign 7 resource routes to TaskController
// Put one code line here below

// End of the /app Route Group


//lARAVEL YOUTUBE COURCE
use App\Http\Controllers\Blog\PostController;
use App\Http\Controllers\Blog\Admin\CategoryController;

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'blog'], function(){
    Route::resource('posts',PostController::class)->names('blog.posts');
});

//blog admin
Route::group(['prefix' => 'admin/blog'], function(){
    $methods = ['index','edit','store','update','create'];
    Route::resource('categories',CategoryController::class)
        ->only($methods)
        ->names('blog.posts');
});
//blog admin end


//lARAVEL YOUTUBE COURCE END
