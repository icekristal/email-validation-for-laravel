<?php
namespace Icekristal\EmailValidationForLaravel;

use Icekristal\EmailValidationForLaravel\Services\EmailValidationService;
use Illuminate\Support\ServiceProvider;

class EmailValidationServiceProvider extends ServiceProvider
{

    public function register(): void
    {
        $this->app->bind('ice.email_validation', EmailValidationService::class);
        $this->registerConfig();
    }
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishMigrations();
            $this->publishConfigs();
        }

    }

    protected function publishMigrations(): void
    {
        if (!class_exists('CreateEmailValidationServicesTable')) {
            $this->publishes([
                __DIR__ . '/../database/migrations/create_email_validation_services_table.php.stub' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_email_validation_services_table.php'),
            ], 'migrations');
        }
    }

    protected function publishConfigs(): void
    {
        $this->publishes([
            __DIR__ . '/../config/email_validation.php' => config_path('email_validation.php'),
        ], 'config');
    }

    protected function registerConfig(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/email_validation.php', 'email_validation');
    }
}
