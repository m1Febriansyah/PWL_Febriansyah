<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LevelController;
use illuminate\Support\Facades\DB;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/level', [LevelController::class, 'index']);

