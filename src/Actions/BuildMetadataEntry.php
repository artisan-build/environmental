<?php

class BuildMetadataEntry
{
    public function __invoke(bool $new = false): string
    {
        return implode(' ', [
            $this->getUserInformation(),
            $new ? 'created' : 'updated',
            'this value at',
            now()->format('Y-m-d H:i:s'),
        ]);
    }

    private function getUserInformation(): string
    {
        // TODO: This will only work if the whatever model or database table the user is stored in has a name column.
        // We need to build this method out to be more robust, so that we can always provide some sort of identifying
        // information on the user regardless of how the auth system is set up.
        return auth()->user()->name;
    }

}
