<?php

namespace Paolooo\Schnauzer\Test\Providers\Jwt;

use Paolooo\Schnauzer\Providers\Jwt\EmarrefJwtProvider;

class EmarrefJwtProviderTest extends \Paolooo\Schnauzer\Test\TestCase
{
    /** @test */
    public function should_instantiate()
    {
        $jwt = new EmarrefJwtProvider('secret');

        $this->assertInstanceOf(
            'Paolooo\Schnauzer\Contracts\Providers\Jwt',
            $jwt
        );
    }

    /** @test */
    public function should_create_a_valid_token()
    {
        $jwt = new EmarrefJwtProvider('secret_key');

        $token= $jwt->createtoken(1);

        $this->assertNotEquals($token, 'Token should not be empty.');

        return $token;
    }

    /**
     * @depends should_create_a_valid_token
     * @test
     */
    public function should_verify_token($token)
    {
        $jwt = new EmarrefJwtProvider('secret_key');

        $valid = $jwt->verify($token);

        $this->assertTrue($valid);
    }

}
