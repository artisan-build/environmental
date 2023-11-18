<?php

declare(strict_types=1);

class GetMetadata
{
    /**
     * @throws JsonException
     */
    public function __invoke($file): array
    {
        $metadata = base_path([implode(DIRECTORY_SEPARATOR, [config('environmental.backup_path'), 'metadata', $file ]), '.json']);
        if (file_exists($metadata)) {
            return json_decode(file_get_contents($metadata), true, 512, JSON_THROW_ON_ERROR);
        }
        $data = Dotenv\Dotenv::parse(file_get_contents(base_path($file)));

        foreach ($data as $k => $v) {
            $metadata[$k] = [[
                app(BuildMetadataEntry::class)(new: true)
            ]];
        }
        return $metadata;
    }

}
