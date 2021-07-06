<?php

namespace App\Infrastructure\Services;

use App\Exceptions\InvalidJWTException;
use App\Services\JWTService;
use Firebase\JWT\JWT;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;

class ImplJWTService implements JWTService
{
    private $key;

    public function __construct(ContainerBagInterface $params)
    {
        $this->key = $params->get('app.jwt_secret');
    }

    /**
     * @throws InvalidJWTException
     */
    public function decode(string $token): array
    {
        $payload = (array) JWT::decode($token, $this->key, array('HS256'));
        if ($this->isExpired($payload)) {
            throw new InvalidJWTException('Expired JWT');
        }
        return $payload;
    }

    public function encode(array $payload, int $ttl = 86400): string
    {
        $payload['iat'] = time();
        $payload['exp'] = time() + $ttl;
        return JWT::encode($payload, $this->key);
    }

    public function isExpired(array $payload): bool
    {
        if (isset($payload['exp']) && is_numeric($payload['exp'])) {
            return (time() - $payload['exp']) > 0;
        }
        return false;
    }
}
