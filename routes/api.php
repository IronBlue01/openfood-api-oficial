<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', 'App\Http\Controllers\ProductController@home')->name('home');
Route::apiResource('products', 'App\Http\Controllers\ProductController');
Route::post('import', 'App\Http\Controllers\ProductController@import')->name('import');
