<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::post('/invoice','InvoiceController@saveInvoice');

Route::get('/sales/chart', 'DataController@sale');
Route::get('/yearly/sales/chart', 'DataController@yearlySale');
Route::get('/monthly/sales/chart', 'DataController@monthlySale');

Route::get('/sale','InventoryController@sale');
Route::post('/store/sale','InventoryController@storeSale');
Route::get('/customers/detail','InventoryController@customersDetail');
Route::post('/update/customer','InventoryController@updateCustomer');

Route::post('/pay','ProductReturnController@payBack');

Route::get('/return/sales/detail','ProductReturnController@retrnedSalesDetail');
Route::post('/return/sale','ProductReturnController@storeSalesReturn');
Route::post('/update/return/sale','ProductReturnController@updateSalesReturn');

Route::get('/return/purchase/detail','ProductReturnController@retrnedPurchaseDetail');
Route::post('/return/purchase','ProductReturnController@storePurchaseReturn');
Route::post('/update/return/purchase','ProductReturnController@updatePurchaseReturn');

Route::get('/purchase','InventoryController@purchase');
Route::get('/retailers/detail','InventoryController@retailersDetail');
Route::post('/store/purchase','InventoryController@storePurchase');
Route::post('/update/retailer','InventoryController@updateRetailer');

Route::get('/stock', 'DataController@stock');
Route::get('/monthly', 'DataController@monthly');
Route::get('/yearly', 'DataController@yearly');

Route::post('/get/retailer','InventoryController@getRetailerById');
Route::post('/get/customer','InventoryController@getCustomerById');
Route::get('/get/retailers','InventoryController@retailers');
Route::get('/get/customers','InventoryController@customers');
Route::get('/get/stock','InventoryController@stocks');

Route::get('/user/detail','UserController@detail');
Route::post('/update/profile','UserController@update');

Route::get('/inventory/products','InventoryController@products');
Route::post('/edit/inventory/product','InventoryController@editProduct');
Route::post('/show/inventory/product','InventoryController@showProduct');
Route::post('/update/product','InventoryController@updateProduct');

Route::get('/{any}', function () {
    return view('welcome');
})->where('any', '.*');


