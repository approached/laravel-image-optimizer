<?php namespace Approached\LaravelImageOptimizer;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $configPath = __DIR__ . '/../config/imageoptimizer.php';
        $this->mergeConfigFrom($configPath, 'imageoptimizer');
    }

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/imageoptimizer.php' => config_path('imageoptimizer.php'),
        ]);
    }
}
