<?php

declare(strict_types=1);

class UpdateMetadata
{
    public function __construct(
        private readonly GetMetadata $getMetadata,
        private readonly BuildMetadataEntry $buildMetadataEntry,
    ) {
    }
    /**
     * @throws JsonException
     */
    public function __invoke(string $file, array $changes): void
    {
        $metadata = ($this->getMetadata)($file);

        foreach ($changes as $k => $v) {
            $metadata[$k][] = ($this->buildMetadataEntry)();
        }

        file_put_contents(base_path([implode(DIRECTORY_SEPARATOR, [config('environmental.backup_path'), 'metadata', $file ]), '.json']), json_encode($metadata, JSON_THROW_ON_ERROR));
    }

}
