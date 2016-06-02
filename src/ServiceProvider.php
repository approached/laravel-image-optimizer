<?php

namespace Approached\LaravelImageOptimizer;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $configPath = __DIR__.'/../config/imageoptimizer.php';
        $this->mergeConfigFrom($configPath, 'imageoptimizer');

        $this->app->singleton('Approached\LaravelImageOptimizer\ImageOptimizer', function ($app) {
            $options = config('imageoptimizer.options');

            // $logger = $this->app->make('log')->getMonolog();
            $logger = new Logger('image_optimizer_log');
            $handler = new StreamHandler(config('imageoptimizer.log_file'), Logger::INFO);
            $logger->pushHandler($handler);

            return new ImageOptimizer($options, $logger);
        });
    }

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/imageoptimizer.php' => config_path('imageoptimizer.php'),
        ]);
    }
}
