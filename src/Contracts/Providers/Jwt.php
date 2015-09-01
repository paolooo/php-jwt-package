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

    /**
     * Verify Token
     *
     * @param string $token Serialized Token
     *
     * @return bool True if serialized token is valid. Otherwise, false.
     */
    public function verify($token);
}
