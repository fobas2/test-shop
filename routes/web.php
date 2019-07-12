<?php

Route::get('/', 'ProductsController@index');
Route::get('/product/{id}', 'ProductsController@view');
Route::get('/shop', 'ShopController@index');
Route::post('/addProduct', 'ShopController@addProduct');