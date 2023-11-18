<?php

use ArtisanBuild\Environmental\Livewire\EditEnvironmentFile;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => config('environmental.route_prefix'),
    'middleware' => ['web', 'auth', 'can:edit-environment'],
], function () {
    Route::get('/{file?}', EditEnvironmentFile::class)->name('environmental.edit');
});
