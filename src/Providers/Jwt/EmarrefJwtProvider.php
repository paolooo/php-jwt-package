<?php

namespace Paolooo\Schnauzer\Providers\Jwt;

use Paolooo\Schnauzer\Contracts\Providers\Jwt as JwtContract;
use Emarref\Jwt\Jwt;
use Emarref\Jwt\Token;
use Emarref\Jwt\Claim;
use Emarref\Jwt\Algorithm\Hs256;
use Emarref\Jwt\Encryption\Factory;
use Emarref\Jwt\Verification\Context;

class EmarrefJwtProvider implements JwtContract
{
    /**
     * @var string
     */
    private $secretKey;

    /**
     * @var string
     */
    private $encryption;

    /**
     * @param string $secretKey Any random key. A secret key.
     */
    public function __construct($secretKey)
    {
        $this->secretKey = $secretKey;

        $algorithm = new Hs256($this->secretKey);
        $this->encryption = Factory::create($algorithm);

        $this->jwt = new Jwt();
    }

    /**
     * Creates Token
     *
     * @param number $id User ID
     *
     * @return string Token
     */
    public function createToken($id)
    {
        $token = new Token();

        // Standard claims are supported
        $token->addClaim(new Claim\Audience('audience_1'));
        $token->addClaim(new Claim\Expiration(new \DateTime('30 minutes')));
        $token->addClaim(new Claim\IssuedAt(new \DateTime('now')));
        $token->addClaim(new Claim\Issuer('your_issuer')); $token->addClaim(new Claim\JwtId('your_id'));
        $token->addClaim(new Claim\NotBefore(new \DateTime('now')));
        $token->addClaim(new Claim\Subject((string)$id));

        $serializedToken = $this->jwt->serialize($token, $this->encryption);

        return $serializedToken;
    }

    /**
     * Verify token
     *
     * @param string $token Serialized Token
     *
     * @return bool True if valid token. Otherwise, false.
     */
    public function verify($token)
    {
        $context = new Context($this->encryption);

        $token = $this->jwt->deserialize($token);

        $payload = $token->getPayload();

        $claimsToVerify = $this->claimsToVerify();

        foreach ($claimsToVerify as $claim) {
            ${$claim} = $payload->findClaimByName($claim)->getValue();
        }

        $context->setAudience($aud);
        $context->setIssuer($iss);
        $context->setSubject($sub);

        return $this->jwt->verify($token, $context);
    }

    /**
     * These are the claims to be verified.
     *
     * @return array Claim names.
     */
    protected function claimsToVerify()
    {
        return [
            Claim\Audience::NAME,
            Claim\Issuer::NAME,
            Claim\Subject::NAME,
        ];
    }

}
