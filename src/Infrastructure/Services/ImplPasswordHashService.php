<?php

namespace App\Infrastructure\Services;

use App\Entity\Activity;
use App\Services\PasswordHashService;
use Symfony\Component\PasswordHasher\Hasher\PasswordHasherFactoryInterface;

class ImplPasswordHashService implements PasswordHashService
{
    /** @var PasswordHasherFactoryInterface */
    private $encoderFactory;

    public function __construct(PasswordHasherFactoryInterface $encoderFactory)
    {
        $this->encoderFactory = $encoderFactory;
    }

    public function hashPassword(string $plainPassword): string
    {
        $encoder = $this->encoderFactory->getPasswordHasher(new Activity());

        return $encoder->hash($plainPassword);
    }
    public function isPasswordValid(string $plainPassword, string $password): bool
    {
        $encoder = $this->encoderFactory->getPasswordHasher(new Activity());
        return (bool) $encoder->verify($password, $plainPassword);
    }
}
