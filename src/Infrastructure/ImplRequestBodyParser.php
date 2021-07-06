<?php

namespace App\Infrastructure;

use App\Services\RequestBodyParser;
use Symfony\Component\HttpFoundation\Request;

class ImplRequestBodyParser implements RequestBodyParser
{
    public function parseBody(Request $request): array
    {
        $bodyAsArray = [];
        if ($content = $request->getContent()) {
            $bodyAsArray = json_decode($content, true);
        }
        return $bodyAsArray;
    }
}
