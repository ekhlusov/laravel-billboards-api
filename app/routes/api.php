<?php

use Illuminate\Http\Request;

Route::get('/billboards', 'BillboardController@index');
Route::get('/billboards/{billboard}', 'BillboardController@show');
Route::post('/billboards/create', 'BillboardController@create');
Route::post('/billboards/update/{billboard}', 'BillboardController@update');
Route::post('/billboards/delete/{billboard}', 'BillboardController@delete');
