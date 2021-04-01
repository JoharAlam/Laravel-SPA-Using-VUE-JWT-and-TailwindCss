<?php

use Illuminate\Support\Facades\Route;

Route::get('/shoes', 'DataController@shoes');
Route::get('/garments', 'DataController@garments');
Route::get('/sale/shoes', 'DataController@monthlySaleShoes');
Route::get('/sale/garments', 'DataController@monthlySaleGarments');

Route::get('/sale','InventoryController@sale');
Route::get('/purchase','InventoryController@purchase');

Auth::routes();

Route::get('/{any}', function () {
    return view('welcome');
})->where('any', '.*');


