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

    /**
     * @param string $secret Secret Key
     * @param Paolooo\Schnauzer\Contracts\Providers\Auth   $auth
     * @param Paolooo\Schnauzer\Contracts\Providers\Jwt    $jwt
     */
    public function __construct(
        $secret,
        AuthProviderContract $auth,
        JwtProviderContract $jwt
    ) {
        $this->secretKey = $secret;

        $this->auth = $auth;
        $this->jwt = $jwt;
    }

}
