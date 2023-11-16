<?php

namespace ArtisanBuild\Environmental\Providers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class EnvironmentalServiceProvider extends ServiceProvider
{
	public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__.'/../../config.php', 'environmental');

        $this->publishes([
            __DIR__.'/../../config.php' => config_path('environmental.php'),
        ], 'config');
	}

	public function boot(): void
    {
        if (! Gate::has('edit-environment')) {
            Gate::define('edit-environment', fn () => App::isLocal());
        }
	}
}
