<?php

namespace Paolooo\Schnauzer\Test\Providers\Auth;

use Mockery as m;
use Paolooo\Schnauzer\Providers\Auth\IlluminateAuthProvider;

class IlluminateAuthProviderTest extends \Paolooo\Schnauzer\Test\TestCase
{
    /**
     * @var Illuminate\Auth\Guard
     */
    private $auth;

    public function setUp()
    {
        $this->auth = m::mock('Illuminate\Auth\Guard');
    }

    public function tearDown()
    {
        m::close();

        $this->auth = null;
    }

    /** @test */
    public function should_instantiate()
    {
        $this->assertInstanceOf(
            'Paolooo\Schnauzer\Contracts\Providers\Auth',
            new IlluminateAuthProvider($this->auth)
        );
    }

    /** @test */
    public function should_authenticate_user_using_illuminate_auth_once()
    {
        $this->auth
            ->shouldReceive('once')
                ->once()
                ->andReturn(true)
            ->getMock();

        $provider = new IlluminateAuthProvider($this->auth);

        $provider->attempt(['dummy', 'password']);
    }
}

