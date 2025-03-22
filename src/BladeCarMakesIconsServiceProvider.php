<?php

declare(strict_types=1);

namespace JohanBoshoff\CarMakesIcons;

use BladeUI\Icons\Factory;
use Illuminate\Contracts\Container\Container;
use Illuminate\Support\ServiceProvider;

final class BladeCarMakesIconsServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->registerConfig();

        $this->callAfterResolving(Factory::class, function (Factory $factory, Container $container) {
            $config = $container->make('config')->get('blade-car-makes-icons', []);

            $factory->add('car-makes-icons', array_merge(['path' => __DIR__.'/../resources/svg'], $config));
        });
    }

    private function registerConfig(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/blade-car-makes-icons.php', 'blade-car-makes-icons');
    }

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../resources/svg' => public_path('vendor/blade-car-makes-icons'),
            ], 'blade-car-makes-icons');

            $this->publishes([
                __DIR__.'/../config/blade-car-makes-icons.php' => $this->app->configPath('blade-car-makes-icons.php'),
            ], 'blade-car-makes-icons-config');
        }
    }
}
