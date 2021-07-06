<?php

namespace App\Services;

use Symfony\Component\HttpFoundation\Request;

interface RequestBodyParser
{
    public function parseBody(Request $request): array;
}
