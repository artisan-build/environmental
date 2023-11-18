# Environmental for Laravel

**Under Construction** This package is not usable yet. Check back soon.

Environmental provides tools for managing your environment variables in a safe and collaborative way. It provides an
online editor where you can edit your .env file. Before any changes are saved, the original file is backed up and the
new contents are validated. If you need to roll back to a previous version of your environment file, you can do it with 
single click.

## Installation

```bash
composer require artisan-build/environmental
```

## Usage

By default, Environmental is available at `/environmental`. You can change this by publishing the config file and 
changing the `route_prefix` value.

### Authorization

By default, everyone can use environmental to manage their own local environment variables. To authorize a user to edit 
.env files in other environments, you'll need to add a gate to the boot method of your `AuthServiceProvider`:

```php
Gate::define('edit-environment', function ($user, $environment) {
    // Use this to preserve the user's ability to edit their own environment
    if (\Illuminate\Support\Facades\App::isLocal()) {
        return true;
    }
    // Example: Allow an admin to edit any environment
    if ($user->isAdmin()) {
        return true;
    }
    // Example: Allow a specific user to edit the staging environment
    if ($user->id === 1 && \Illuminate\Support\Facades\App::environment('staging')) {
        return true;
    }
    return false;
});
```

## Additional Environment Files

We use Laravel Vapor for several of our projects and to save GitHub Actions minutes, we deploy our staging and
production environments from a Forge-built server. This means that we have an .env.production and .env.staging file in
the root of our `ci` environment. Environmental lets us edit both of those files and the .env file on our deployment
server. To give Environmental access to additional files, you can add them to the `additional_environment_files` array
in the config file. If those files exist on the server, you'll be able to select them from a drop-down box at the top 
of the edit page.

## Backups

By default, Environmental will keep the 3 most recent backups of your environment file, but we will not delete any file
that is not at least a week old. This way, if you make several changes quickly and then realize you need to just start
over, you can do it with a single click. You can change the number of backups and minimum age of backups by publishing
and editing the configuration file.

