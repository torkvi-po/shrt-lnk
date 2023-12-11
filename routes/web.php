<?php

use App\Http\Controllers\IndexController;
use Illuminate\Support\Facades\Route;

Route::controller(IndexController::class)
    ->group(function() {
        Route::get('/', 'index')->name('homepage');
        Route::get('{url}', 'getUrl')->name('getUrl');
        Route::post('/~make', 'make')->name('make');
        Route::post('/~generate', 'generate')->name('generate');
    });
