<?php

namespace Paolooo\Schnauzer\Contracts\Providers;

interface Jwt
{
    /**
     * Creates a token
     *
     * @param number $id User Id
     *
     * @return string Valid JWT Token
     */
    public function createToken($id);
}
