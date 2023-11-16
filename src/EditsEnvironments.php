<?php

use Illuminate\Support\Facades\App;

trait EditsEnvironments
{
    public function canEditEnvironment(): bool
    {
        return App::isLocal();
    }
}
