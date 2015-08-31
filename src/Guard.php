<?php

namespace Paolooo\Schnauzer;

use Paolooo\Schnauzer\Contracts\Providers\Auth as AuthProviderContract;
use Paolooo\Schnauzer\Contracts\Providers\Jwt as JwtProviderContract;

abstract class Guard
{
    /**
     * @var string
     */
    protected $secretKey;

    /**
     * @var AuthProvider
     */
    protected $auth;

    /**
     * @var JwtProvider
     */
    protected $jwt;

    public function __construct(AuthProviderContract $auth, JwtProviderContract $jwt)
    {
        $this->auth = $auth;
        $this->jwt = $jwt;

        $this->secretKey = 'secret';
    }

}
