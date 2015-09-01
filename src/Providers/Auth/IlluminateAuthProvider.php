<?php

namespace Paolooo\Schnauzer\Providers\Auth;

use Illuminate\Contracts\Auth\Guard;
use Paolooo\Schnauzer\Contracts\Providers\Auth;

class IlluminateAuthProvider implements Auth
{
    /**
     * @var Illuminate\Contracts\Auth\Guard
     */
    private $auth;

    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * {@inheritDoc}
     */
    public function attempt(array $credentials)
    {
        return $this->auth->once($credentials);
    }
}
