<?php

use Illuminate\Support\Facades\File;

class CreateBackup
{
    /**
     * @throws Throwable
     */
    public function __invoke(string $file = '.env', array $expected = []): void
    {
        // If the backup directory does not exist, create it
        File::ensureDirectoryExists(config('environmental.backup_path'));

        // Create a backup of the file in the config('environmental.backup_path') directory
        File::copy(
            base_path($file),
            config('environmental.backup_path') . '/' . $file . '-' . date('Y-m-d-H-i-s')
        );


        throw_if(app(ValidateNewFile::class)(config('environmental.backup_path')
            . '/' . $file . '-' . date('Y-m-d-H-i-s'), $expected)
            , new FileValidationException('The backup did not contain the expected data so we could not save your changes.'));
    }

}
