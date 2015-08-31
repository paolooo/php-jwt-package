<?php

namespace Paolooo\Schnauzer\Contracts;

interface Authenticatable
{
    /**
     * Authenticate user's credential.
     *
     * @param array $credentials
     *
     * @return bool True when valid. Otherwise, false.
     */
    public function attempt(array $credentials);
}
