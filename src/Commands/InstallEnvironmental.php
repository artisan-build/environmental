<?php

namespace ArtisanBuild\Environmental\Commands;

use Illuminate\Console\Command;

use function Laravel\Prompts\text;

class InstallEnvironmental extends Command
{
    protected $signature = 'environmental:install';
    protected $description = 'Set up and configure the environmental package';

    public function handle(): int
    {
        $backupPath = text('Where would you like to store your backups?', 'backup_path', base_path('.environmental'));

        if ($backupPath !== config('environmental.backup_path')) {
            $this->info('Setting backup path to ' . $backupPath);

            config(['environmental.backup_path' => $backupPath]);
        }
        return self::SUCCESS;
    }
}
