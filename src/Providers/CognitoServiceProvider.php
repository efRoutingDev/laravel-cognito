<?php

namespace Efrouting\LaravelCognito\Providers;

use Illuminate\Support\ServiceProvider;

class CognitoServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__.'/config/cognito.php' => config_path('cognito.php'),
        ]);

        $this->app->singleton('cognito', function ($app) {
            return new \Efrouting\LaravelCognito\Singletons\CognitoClientSingleton();
        });
    }

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/config/cognito.php', 'cognito'
        );

        //Initialize CognitoClientSingleton
        $cognitoClient = $this->app->make('cognito');
        $cognitoClient->init();
    }
}