<?php

namespace App\Services;

interface PasswordHashService
{
    public function hashPassword(string $plainPassword): string;
    public function isPasswordValid(string $plainPassword, string $password): bool;
}
