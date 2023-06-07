<?php

namespace Efrouting\LaravelCognito\Providers;

use Illuminate\Support\ServiceProvider;

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
        $this->app->singleton('cognito', function ($app) {
            return new \Efrouting\LaravelCognito\Singletons\CognitoClientSingleton();
        });
    }

    public function register()
    {
        //Initialize CognitoClientSingleton
        $cognitoClient = $this->app->make('cognito');
        $cognitoClient->init();
    }
}