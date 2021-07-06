<?php

namespace App\Securety;

use App\Exceptions\CustomAuthenticationException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Guard\AbstractGuardAuthenticator;

abstract class GuardAuthenticator extends AbstractGuardAuthenticator
{

    /**
     * @param Request $request
     * @param AuthenticationException|null $authException
     * @return Response|void
     */
    public function start(Request $request, AuthenticationException $authException = null)
    {
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        $message = 'Invalid Credentials';

        if ($exception instanceof CustomAuthenticationException) {
            $message = $exception->getMessageKey();
        }

        throw new HttpException(401, $message);
    }

    /**
     * @param Request $request
     * @param TokenInterface $token
     * @param string $providerKey
     * @return Response|void|null
     */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $providerKey)
    {
    }

    public function supportsRememberMe(): bool
    {
        return false;
    }

    public function supports(Request $request)
    {
        return true;
    }
}
