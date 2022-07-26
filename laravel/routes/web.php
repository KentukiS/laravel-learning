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

Route::get('/', 'App\Http\Controllers\HomeController@index');
Route::get('/user/{name}', 'App\Http\Controllers\UserController@show');
Route::view('/about', 'pages.about');
Route::get('/log-in', function () {
    return redirect('/login');
});

//lARAVEL YOUTUBE COURCE
use App\Http\Controllers\Blog\PostController;
use App\Http\Controllers\Blog\Admin\CategoryController;
use App\Http\Controllers\Blog\Admin\PostController as AdminPostController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;

//Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'blog'], function(){
    Route::resource('posts',PostController::class)->names('blog.posts');
});

//blog admin
Route::group(['prefix' => 'admin/blog','middleware' => 'isAdmin'], function(){
    Route::resource('categories',CategoryController::class)
        ->names('blog.admin.categories');
    Route::resource('posts',AdminPostController::class)
        ->except(['show'])
        ->names('blog.admin.posts');
});
//blog admin end

//auth routes
Route::name('user.')->group(function(){
   Route::view('/private','auth.private')->middleware('auth')->name('private');

   Route::get('/login',function (){
       return view('auth.login');
   })->name('login');

    Route::post('/login',[LoginController::class,'login']);

    Route::get('/logout',function(){
        Auth::logout();
        return redirect("/");
    })->name('logout');

    Route::get('/register',function (){
        return view('auth.register');
    })->name('register');

    Route::post('/register',[RegisterController::class,'save']);
});
//auth routes end


//lARAVEL YOUTUBE COURCE END
