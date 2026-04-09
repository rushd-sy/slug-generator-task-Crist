<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SlugController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/generate-slug', [SlugController::class, 'generate']);
