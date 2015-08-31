<?php

namespace Paolooo\Schnauzer\Test;

use Mockery as m;
use Paolooo\Schnauzer\Schnauzer;

class SchnauzerTest extends TestCase
{
    /**
     * @var Paolooo\Schnauzer\Contracts\Providers\Auth
     */
    protected $auth;

    /**
     * @var Paolooo\Schnauzer\Contracts\Providers\Jwt
     */
    protected $jwt;

    public function setUp()
    {
        $this->auth = m::mock('Paolooo\Schnauzer\Contracts\Providers\Auth');

        $this->jwt = m::mock('Paolooo\Schnauzer\Contracts\Providers\Jwt');
    }


    public function tearDown()
    {
        $this->auth = null;
        $this->jwt = null;

        m::close();
    }

    /** @test */
    public function should_instantiate()
    {
        $auth = new Schnauzer($this->auth, $this->jwt);

        $this->assertInstanceOf('Paolooo\Schnauzer\Schnauzer', $auth);
    }

    /** @test */
    public function should_authenticate_use_and_return_a_token()
    {
        $this->auth
            ->shouldReceive('attempt')->once()->withAnyArgs()->andReturn(true)
            ->shouldReceive('id')->once()->andReturn('1')
            ->getMock();

        $this->jwt
            ->shouldReceive('createToken')->once()->andReturn('sampleToken')
            ->getMock();

        $auth = new Schnauzer($this->auth, $this->jwt);

        $credentials = ['username' => 'john@doe.com', 'password' => '123'];

        $token = $auth->attempt($credentials);

        $this->assertNotEmpty($token, 'Should return token.');

        return $token;
    }

    /**
     * @depends should_authenticate_use_and_return_a_token
     * @test
     */
    public function should_verify_token($token)
    {
        $this->jwt
            ->shouldReceive('verifyToken')->once()->andReturn(true)
            ->getMock();

        $auth = new Schnauzer($this->auth, $this->jwt);

        $valid = $auth->verifyToken($token);

        $this->assertTrue($valid);
    }

    /** @test */
    public function should_create_token()
    {
        $this->jwt
            ->shouldReceive('createToken')->once()->andReturn('sampleToken')
            ->getMock();

        $auth = new Schnauzer($this->auth, $this->jwt);

        $token = $auth->createToken(1);

        $this->assertNotEquals($token, 'Token is empty.');
    }

}
