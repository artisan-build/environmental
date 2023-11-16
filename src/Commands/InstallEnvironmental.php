<?php

namespace ArtisanBuild\Environmental\Commands;

use Illuminate\Console\Command;

use Illuminate\Support\Facades\Artisan;
use function Laravel\Prompts\text;

class InstallEnvironmental extends Command
{
    protected $signature = 'environmental:install';
    protected $description = 'Set up and configure the environmental package';

    public function handle(): int
    {
        Artisan::call('vendor:publish', [
            '--provider' => 'ArtisanBuild\Environmental\Providers\EnvironmentalServiceProvider',
            '--tag' => 'config',
        ]);

        return self::SUCCESS;
    }
}
