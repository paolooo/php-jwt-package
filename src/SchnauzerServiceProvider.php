<?php

namespace Paolooo\Schnauzer;

use Illuminate\Support\ServiceProvider;
use Paolooo\Schnauzer\Contracts\Providers\Auth;
use Paolooo\Schnauzer\Contracts\Providers\Jwt;

class SchnauzerServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('schnauzer', function($app) {
            $schnauzer = new Schnauzer('secret');
        });
    }
}
