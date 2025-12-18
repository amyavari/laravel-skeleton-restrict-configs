# laravel-skeleton-restrict-configs

This is a template to start a new Laravel project with a set of packages and restrictive configurations, following best practices and based on the Laravel Livewire starter kit.

* Custom Laravel configurations (see [app/Providers/AppServiceProvider](./app/Providers/AppServiceProvider.php))
* `make:action` command for creating new action classes
* Preconfigured `Rector`, `Pint`, and `PHPStan` to get the most out of their capabilities
  (see [rector.php](./rector.php), [pint.json](./pint.json), and [phpstan.neon](./phpstan.neon))
* Installed `opcodesio/log-viewer` for better log tracking
* Installed required `pestphp/pest` plugins for full application testing
