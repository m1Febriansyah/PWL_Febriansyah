<?php

use Illuminate\Support\Facades\Route;
Route::get('/hello', function () {
return 'Hello World';
});

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

