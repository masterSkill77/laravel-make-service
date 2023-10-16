<?php

namespace Masterskill\ServicePackage;

use Illuminate\Support\ServiceProvider;
use Masterskill\ServicePackage\Commands\MakeService;

class MakeServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/service-package.php' => config_path('service-package.php'),
        ], 'config');
    }

    public function register()
    {
        $this->commands([
            MakeService::class,
        ]);
    }
}
