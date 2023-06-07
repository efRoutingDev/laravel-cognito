<?php

namespace Efrouting\LaravelCognito\Providers;

use Illuminate\Support\ServiceProvider;
use Efrouting\LaravelCognito\Singletons\CognitoClientSingleton;

class CognitoServiceProvider extends ServiceProvider
{
    private $configPath = __DIR__.'/../../config/config.php';

    public function boot()
    {
        //Publish config file
        $this->publishes([
            $this->configPath => config_path('cognito.php'),
        ], 'config');

        $this->mergeConfigFrom($this->configPath, 'cognito');

        //Register CognitoClientSingleton
        $this->app->singleton(CognitoClientSingleton::class, function ($app) {
            return new CognitoClientSingleton();
        });
    }

    public function register()
    {

    }
}