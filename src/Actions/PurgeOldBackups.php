<?php

use Illuminate\Support\Facades\File;

class PurgeOldBackups
{
    public function __invoke(string $fileName = '.env'): void
    {
        // Get all the files in the backup directory
        $files = File::files(config('environmental.backup_path'));

        // If there are more than the number of backups to keep
        if (count($files) > config('environmental.backups_to_keep')) {
            // Sort the files by date
            usort($files, function ($a, $b) {
                return filemtime($a) < filemtime($b);
            });

            // Filter for files that start with $file . '-'
            $files = array_filter($files, static function ($file) use ($fileName) {
                return str_starts_with($file->getFilename(), $fileName . '-');
            });

            // Delete all but the first $backupsToKeep files
            array_slice($files, config('environmental.backups_to_keep') - 1, null, true);
            foreach ($files as $file) {
                File::delete($file->getPathname());
            }
        }
    }
}
