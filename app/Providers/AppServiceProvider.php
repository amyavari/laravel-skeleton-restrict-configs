<?php

declare(strict_types=1);

namespace App\Providers;

use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

final class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->configureCommands();
        $this->configureModels();
        $this->configureUrl();
        $this->configureDates();
    }

    /**
     * Block destructive commands in production. Like:
     *
     * - db:wipe
     * - migrate:fresh
     * - migrate:refresh
     * - migrate:reset
     * - migrate:rollback
     */
    private function configureCommands(): void
    {
        DB::prohibitDestructiveCommands(
            (bool) $this->app->environment('production')
        );
    }

    /**
     * Prevent dangerous behavior and be more restrictive.
     *
     * - Prevent lazy loading.
     * - Prevent silently discarding attributes (in mass assignment).
     * - Prevent accessing missing attributes.
     * - Disable all mass assignable restrictions
     * - Model relationships should be automatically eager loaded when accessed
     */
    private function configureModels(): void
    {
        Model::shouldBeStrict();
        Model::unguard();
        Model::automaticallyEagerLoadRelationships();
    }

    /**
     * Only handle HTTPS requests.
     */
    private function configureUrl(): void
    {
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }
    }

    /**
     * Get new instance of date each time we modify it.
     */
    private function configureDates(): void
    {
        Date::use(CarbonImmutable::class);
    }
}
