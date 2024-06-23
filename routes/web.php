<?php

use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/test/{id?}/{name?}', function ($id = 10, $name = 'Guillermo') {
//    echo $id; 
//    echo $name;
// });

// Route::controller(PostController::class)->group(function () {
// Route::get('post','index')->name("post.index");
// Route::get('post/{post}','show')->name("post.show");
// Route::get('post/create','create')->name("post.create");
// Route::get('post/{post}/edit','edit')->name("post.edit");

// Route::post('post','store')->name("post.store");
// Route::put('post/{post}','update')->name("post.update");
// Route::delete('post/{post}','delete')->name("post.destroy"); 
// });

Route::resource('post', PostController::class);
Route::resource('category', CategoryController::class);

