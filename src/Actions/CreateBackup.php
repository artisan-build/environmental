<?php

use Illuminate\Support\Facades\File;

class CreateBackup
{
    public function __invoke(string $file = '.env'): void
    {
        // If the backup directory does not exist, create it
        File::ensureDirectoryExists(config('environmental.backup_path'));

        // Create a backup of the file in the config('environmental.backup_path') directory
        File::copy(
            base_path($file),
            config('environmental.backup_path') . '/' . $file . '-' . date('Y-m-d-H-i-s')
        );
    }

}
