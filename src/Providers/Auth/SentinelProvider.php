<?php

namespace Paolooo\Schnauzer\Providers\Auth;

use Paolooo\Schnauzer\Contracts\Providers\Auth;
use Cartalyst\Sentinel\Sentinel;

class SentinelProvider implements Auth
{
    /**
     * @var Cartalyst\Sentinel\Sentinel
     */
    private $sentinel;

    /**
     * @param Cartalyst\Sentinel\Sentinel $sentinel
     */
    public function __construct(Sentinel $sentinel)
    {
        $this->sentinel = $sentinel;
    }

    /**
     * {@inheritDoc}
     */
    public function attempt(array $credentials)
    {
        return $this->sentinel->stateless($credentials);
    }
}
