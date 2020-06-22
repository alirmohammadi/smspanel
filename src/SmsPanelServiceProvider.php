<?php


namespace Alirmohammadi\SmsPanel;


use Illuminate\Support\ServiceProvider;

class SmsPanelServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/config/smspanel.php' =>config_path('smspanel.php')],'config'
        );
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {

    }
}
