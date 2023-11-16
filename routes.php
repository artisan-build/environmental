<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => config('environmental.route_prefix'),
    'middleware' => ['web', 'auth', 'can:edit-environment'],
], function () {
    Route::get('/', 'EnvironmentalController@index')->name('environmental.index');
    Route::post('/', 'EnvironmentalController@store')->name('environmental.store');
});
