<?php

use Illuminate\Support\Facades\Route;

Route::get('/coins', 'DataController@coins');

Auth::routes();

Route::get('/{any}', function () {
    return view('welcome');
})->where('any', '.*');


