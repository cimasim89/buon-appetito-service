<?php

namespace App\Services;

interface JWTService
{
    public function decode(string $token): array;
    public function encode(array $payload, int $ttl = 86400): string;
    public function isExpired(array $payload): bool;
}
