<?php

namespace Paolooo\Schnauzer\Test\Providers\Auth;

use Mockery as m;
use Paolooo\Schnauzer\Providers\Auth\SentinelProvider;

class SentinelProviderTest extends \Paolooo\Schnauzer\Test\TestCase
{
    private $sentinel;

    public function setUp()
    {
        $this->sentinel = m::mock('Cartalyst\Sentinel\Sentinel');
    }

    public function tearDown()
    {
        m::close();

        $this->sentinel = null;
    }

    /** @test */
    public function should_instantiate()
    {
        $provider = new SentinelProvider($this->sentinel);

        $this->assertInstanceOf('Paolooo\Schnauzer\Contracts\Providers\Auth', $provider);
    }

    /** @test */
    public function should_authenticate_credentials_using_sentinel()
    {
        $this->sentinel
            ->shouldReceive('stateless')
                ->once()
                ->andReturn(true)
            ->getMock();

        $provider = new SentinelProvider($this->sentinel);

        $provider->attempt(['dummy', 'password']);
    }

}
