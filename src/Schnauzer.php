<?php

namespace Paolooo\Schnauzer;

use Paolooo\Schnauzer\Contracts\Guard as GuardContract;
use Cartalyst\Sentinel\Sentinel;
use Emarref\Jwt\Jwt;
use Emarref\Jwt\Token;
use Emarref\Jwt\Claim;

class Schnauzer extends Guard implements GuardContract
{
    /**
     * {@inheritDoc}
     */
    public function attempt(array $credentials)
    {
        $valid = $this->auth->attempt($credentials);

        if ($valid) {
            return $this->createToken($this->auth->id());
        }

        return false;
    }

    /**
     * {@inheritDoc}
     */
    public function createToken($id)
    {
        return $this->jwt->createToken($id);
    }

    /**
     * {@inheritDoc}
     */
    public function verifyToken($serializedToken)
    {
        return $this->jwt->verifyToken($serializedToken);
    }

}
