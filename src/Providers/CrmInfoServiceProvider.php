<?php declare(strict_types=1);

namespace Ir\Crminfo\Providers;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\ServiceProvider;
use Ir\Crminfo\View\Components\Footer;

/**
 * Провайдер для регистрации сервисов
 */
class CrmInfoServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config/crm-info.php', 'crm-info');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/../../config/crm-info.php' => config_path('crm-info.php'),
        ]);

        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'crm-info');
        $this->loadViewComponentsAs('crm-info', [
            Footer::class,
        ]);

        // Регистрация клиента для получения информации из CRM
        $this->app->singleton('crm-info', function() {
            if (!app()->environment('production')) {
                return new \Ir\Crminfo\Client\Mock();
            }

            return new \Ir\Crminfo\Client\Http();
        });

        $this->launchCommand();
    }

    /**
     * Регистрация консольной команды
     */
    protected function launchCommand(): void
    {
        $this->commands([
            \Ir\Crminfo\Console\Commands\CrminfoCommand::class,
        ]);

        Artisan::call(\Ir\Crminfo\Console\Commands\CrminfoCommand::class);
    }
}
