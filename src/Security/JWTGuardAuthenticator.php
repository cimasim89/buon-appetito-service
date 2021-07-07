<?php

namespace App\Security;

use App\Exceptions\CustomAuthenticationException;
use App\Exceptions\InvalidJWTException;
use App\Services\JWTService;
use Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class JWTGuardAuthenticator extends GuardAuthenticator
{
    private $jwtService;

    public function __construct(JWTService $jwtService)
    {
        $this->jwtService = $jwtService;
    }

    public function supports(Request $request): bool
    {
        return true;
    }

    public function getCredentials(Request $request)
    {
        if (!$request->headers->has('Authorization')) {
            throw new CustomAuthenticationException('Missing Authorization Header');
        }

        $headerParts = explode(' ', $request->headers->get('Authorization'));

        if (!(count($headerParts) === 2 && $headerParts[0] === 'Bearer')) {
            throw new CustomAuthenticationException('Malformed Authorization Header');
        }

        return $headerParts[1];
    }

    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        try {
            $payload = $this->jwtService->decode($credentials);
        } catch (InvalidJWTException $e) {
            throw new CustomAuthenticationException($e->getMessage());
        } catch (Exception $e) {
            throw new CustomAuthenticationException('Malformed JWT');
        }

        if (!isset($payload['email'])) {
            throw new CustomAuthenticationException('Invalid JWT');
        }
        return $userProvider->loadUserByIdentifier($payload['email']);
    }

    public function checkCredentials($credentials, UserInterface $user): bool
    {
        return true;
    }
}
