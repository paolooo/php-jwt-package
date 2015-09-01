<?php

namespace Paolooo\Schnauzer;

use Paolooo\Schnauzer\Contracts\Providers\Auth as AuthProviderContract;
use Paolooo\Schnauzer\Contracts\Providers\Jwt as JwtProviderContract;

abstract class Guard
{
    /**
     * @var AuthProvider
     */
    protected $auth;

    /**
     * @var JwtProvider
     */
    protected $jwt;

    /**
     * @param Paolooo\Schnauzer\Contracts\Providers\Auth   $auth
     * @param Paolooo\Schnauzer\Contracts\Providers\Jwt    $jwt
     */
    public function __construct(
        AuthProviderContract $auth,
        JwtProviderContract $jwt
    ) {
        $this->auth = $auth;
        $this->jwt = $jwt;
    }

}
