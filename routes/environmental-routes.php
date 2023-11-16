<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => config('environmental.route_prefix', 'environmental'),
    'middleware' => config('environmental.route_middleware', ['web', 'auth']),
], function() {
    // List environment files
    // Edit environment file
    // Save environment file
    // Create environment file
});
