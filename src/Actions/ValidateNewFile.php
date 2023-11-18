<?php

use Dotenv\Dotenv;

class ValidateNewFile
{
    public function __invoke(string $file, array $expected): bool
    {
        $actual = Dotenv::parse(file_get_contents($file));

        ksort($actual);
        ksort($expected);

        return $actual === $expected;
    }

}
