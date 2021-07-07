<?php

namespace App\Security;

use App\Services\PasswordHashService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class EmailPasswordGuardAuthenticator extends GuardAuthenticator
{
    private $passwordHashService;

    public function __construct(PasswordHashService $passwordHashService)
    {
        $this->passwordHashService = $passwordHashService;
    }

    public function getCredentials(Request $request): array
    {
        if (!$request->isMethod('POST')) {
            throw new MethodNotAllowedHttpException(['POST']);
        }

        return [
            'email' => $request->request->get('email'),
            'password' => $request->request->get('password'),
        ];
    }

    public function getUser($credentials, UserProviderInterface $userProvider): ?UserInterface
    {
        return $userProvider->loadUserByIdentifier($credentials['email']);
    }

    public function checkCredentials($credentials, UserInterface $user): bool
    {
        $plainPassword = $credentials['password'];

        $res = $this->passwordHashService->isPasswordValid($plainPassword, $user->getPassword());

        if (!$res) {
            throw new BadCredentialsException();
        }
        return true;
    }
}
