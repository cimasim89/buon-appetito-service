<?php

namespace App\Infrastructure;

use App\Services\UuidService;

class ImplUuidService implements UuidService
{

    public function generateUuid(): string
    {
        return uuid_create(UUID_TYPE_RANDOM);
    }
}
