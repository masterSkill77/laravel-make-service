<?php

namespace Masterskill\ServicePackage;

use Illuminate\Support\ServiceProvider;
use Masterskill\ServicePackage\Commands\MakeService;

class MakeServiceProvider extends ServiceProvider
{
    public function boot()
    {
    }

    public function register()
    {
        $this->commands([
            MakeService::class,
        ]);
    }
}
