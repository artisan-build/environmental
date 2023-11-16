<?php

use Dotenv\Dotenv;
use Illuminate\Support\Facades\File;

class SetEnvironmentVariable
{
    public function __invoke(string $key, ?string $value = null, $file_name = '.env')
    {
        $env = Dotenv::parse(base_path($file_name));

        $env[$key] = $value;

        $contents = '';
        foreach ($env as $k => $v) {
            $contents .= "{$k}={$v}\n";
        }

        File::put(base_path($file_name), $contents . "\n");

    }
}
