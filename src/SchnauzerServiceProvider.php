<?php

namespace Paolooo\Schnauzer;

use Illuminate\Support\ServiceProvider;
use Paolooo\Schnauzer\Contracts\Providers\Auth;
use Paolooo\Schnauzer\Contracts\Providers\Jwt;
use Paolooo\Schnauzer\Providers\Auth\SentinelProvider;
use Paolooo\Schnauzer\Providers\Jwt\EmarrefJwtProvider;

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

            $secretKey = 'secret';

            $authProvider = new SentinelProvider($app['sentinel']);
            $jwtProvider = new EmarrefJwtProvider($secretKey);

            $schnauzer = new Schnauzer($authProvider, $jwtProvider);

            return $schnauzer;
        });
    }
}
