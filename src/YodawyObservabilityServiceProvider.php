<?php

namespace Yodawy\Observability;

use Illuminate\Support\ServiceProvider;

class YodawyObservabilityServiceProvider extends ServiceProvider
{
    /**
    * Publishes configuration file.
    *
    * @return  void
    */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/yodawy_observability.php' => config_path('yodawy_observability.php'),
        ], 'yodawy-observability-config');
    }
    /**
    * Make config publishment optional by merging the config from the package.
    *
    * @return  void
    */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/yodawy_observability.php',
            'yodawy_observability'
        );
    }
}