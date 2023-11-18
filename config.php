<?php

return [
    'route_prefix' => 'environmental',
    'backup_number' => 3, // We keep at least the last 3 backups (see age below). Set to null to keep all backups forever.
    'backup_path' => base_path('.environmental'),
    'minimum_backup_age' => 60 * 60 * 24 * 7, // We won't delete any backup that is not at least 1 week old
    'additional_environment_files' => [],
    'form_layout' => 'environmental::layout', // Change to your own app-layout (or whatever) to match your site
];
