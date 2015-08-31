<?php

namespace Paolooo\Schnauzer\Contracts;

interface Guard
{
    /**
     * Authenticate user's credentials
     *
     * @param array $credentials
     *
     * @return string|bool Returns token on success. Otherwise, false.
     */
    public function attempt(array $credentials);

    /**
     * Creates a JWT token
     *
     * @param string $id
     *
     * @return string JWT Token
     */
    public function createToken($id);

    /**
     * Verifies token
     *
     * @param string $serializedToken
     *
     * @return bool True, if valid. Otherwise, false.
     */
    public function verifyToken($serializedToken);
}
