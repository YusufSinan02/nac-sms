<?php

namespace NacSms;

use Illuminate\Support\ServiceProvider;

class NacSmsServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/nac-sms.php', 'nac-sms');

        $this->app->singleton(NacSms::class, function () {
            return new NacSms(
                config('nac-sms.username'),
                config('nac-sms.password'),
                config('nac-sms.base_url'),
            );
        });

        $this->app->alias(NacSms::class, 'nac-sms');
    }

    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/../config/nac-sms.php' => config_path('nac-sms.php'),
        ], 'nac-sms-config');
    }
}
