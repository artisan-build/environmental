<?php

namespace ArtisanBuild\Environmental\Models;

use Dotenv\Dotenv;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Sushi\Sushi;

class Environment extends Model
{
    use Sushi;
    public static string $file = '';

    protected $rows = [];

    public function sushiShouldCache()
    {
        return true;
    }

    public function getRows(): array
    {
        $records = $this->getArraysFromEnvironmentFiles();
        $keys = collect($records)->map(fn($record) => array_keys($record))->flatten()->unique()->sort()->toArray();
        $normalized = collect($records)->map(fn($record) => array_merge(array_fill_keys($keys, ''), $record))->sortKeys()->toArray();
        return array_values($normalized); // Reset the indexes on the array because Sushi expects them to be sequential starting with 0
    }

    public function getArraysFromEnvironmentFiles(): array
    {
        return array_filter(collect(File::files(base_path(), true))
            ->filter(fn($file) => str_starts_with($file->getFilename(), '.env'))
            ->map(function ($file) {
                $contents = file_get_contents($file->getPathname());
                if (count(Dotenv::parse($contents)) > 0) {
                    $record = Dotenv::parse($contents);
                    $record['id'] = $file->getFilename();
                    return $record;
                }
                return null;
            })->toArray());
    }
}
