<?php

declare(strict_types=1);

namespace GlovoPlugin;

use Illuminate\Support\ServiceProvider;

class GlovoPluginServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__.'/config/config.php',
            'glovo'
        );
    }

    public function boot(): void
    {
        $this->publishes(
            [
                __DIR__.'/config/config.php' => config_path('config.php'),
            ],
        );

        $this->loadRoutesFrom(__DIR__.'/routes/glovo.php');
    }
}
