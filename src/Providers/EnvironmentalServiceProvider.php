<?php

namespace ArtisanBuild\Environmental\Providers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class EnvironmentalServiceProvider extends ServiceProvider
{
	public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__.'/../../config.php', 'environmental');

        $this->publishes([
            __DIR__.'/../../config.php' => config_path('environmental.php'),
        ], 'config');

        $this->loadRoutesFrom(__DIR__.'/../../routes.php');

	}

	public function boot(): void
    {
        if (! Gate::has('edit-environment')) {
            Gate::define('edit-environment', fn () => App::isLocal());
        }
        Livewire::component('environmental::edit-environment-file', \ArtisanBuild\Environmental\Livewire\EditEnvironmentFile::class);
	}
}
