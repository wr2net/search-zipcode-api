<?php

use Illuminate\Support\Facades\Route;

Route::get('zipCodes', 'ZipCodeController@index')
    ->name('index');

Route::post('zipCodes', 'ZipCodeController@store')
    ->name('store');

Route::post('zipCodes/ByZipCode', 'ZipCodeController@searchByZipCode')
    ->name('searchByZipCode');

Route::post('zipCodes/ByAddress', 'ZipCodeController@searchByAddress')
    ->name('searchByAddress');

Route::get('zipCodes/{zipCode}', 'ZipCodeController@show')
    ->name('show');

Route::put('zipCodes/{zipCode}', 'ZipCodeController@update')
    ->name('update');

Route::middleware(['auth:api'])->patch('zipCodes/{zipCode}/disable', 'ZipCodeController@disable')
    ->name('disable');

Route::middleware(['auth:api'])->patch('zipCodes/{zipCode}/enable', 'ZipCodeController@enable')
    ->name('enable');

Route::middleware(['auth:api'])->delete('zipCodes/{zipCode}', 'ZipCodeController@destroy')
    ->name('destroy');
