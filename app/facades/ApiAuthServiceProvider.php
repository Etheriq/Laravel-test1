<?php
namespace proj1\facades;

use Illuminate\Support\ServiceProvider;

class ApiAuthServiceProvider extends ServiceProvider {

    public function register() {

        $this->app['apiauthfacade'] = $this->app->share(function($app)
        {
            return new ApiAuth;
        });

        $this->app->booting(function()
        {
            $loader = \Illuminate\Foundation\AliasLoader::getInstance();
            $loader->alias('ApiAuth', 'proj1\facades\ApiAuthFacade');
        });
    }
} 