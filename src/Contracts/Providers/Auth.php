<?php

namespace Paolooo\Schnauzer\Contracts\Providers;

interface Auth
{
    /**
     * Authenticates user credentials
     *
     * @param array $credentials User credentials. This should have 'password' and 'email' keys.
     *
     * @return bool True if valid credentias. Otherwise, false.
     */
    public function attempt(array $credentials);
}
