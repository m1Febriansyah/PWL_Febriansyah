<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\WelcomeController;
Route::get('/greeting', [WelcomeController::class, 'greeting']);

use App\Http\Controllers\HomeController;
Route::get('/', [HomeController::class, 'index']);

use App\Http\Controllers\AboutController;
Route::get('/about', [AboutController::class, 'about']);

use App\Http\Controllers\ArticleController;
Route::get('/articles/{id}', [ArticleController::class, 'articles']);

use App\Http\Controllers\PhotoController;
Route::resource('photos', PhotoController::class);
Route::resource('photos',
PhotoController::class)->only([ 'index', 'show'
]);
Route::resource('photos',
PhotoController::class)->except([ 'create', 'store',
'update', 'destroy'
]);



Route::get('/world', function () {
    return 'World';
});

Route::get('/', function () {
    return 'Selamat Datang';
});

Route::get('/about', function () {
    return 'Nama :Muhammad Febriansyah, NIM :244107020199';
});

Route::get('/user/{name}', function ($name) {
    return 'Nama saya '.$name;
});

Route::get('/posts/{post}/comments/{comment}',
function ($postId, $commentId) {
return 'Pos ke-'.$postId." Komentar ke-: ".$commentId;
});

Route::get('/articles/{id}',
function ($articlesId) {
return 'Artikel ke-'.$articlesId;
});

Route::get('/user/{name?}', function ($name='John')
{ return 'Nama saya '.$name;
});


