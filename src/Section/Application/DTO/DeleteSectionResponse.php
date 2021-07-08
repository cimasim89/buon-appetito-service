<?php

namespace App\Section\Application\DTO;

class DeleteSectionResponse
{

    public $done;

    public function __construct(bool $done)
    {
        $this->done = $done;
    }

    public static function create(bool $done): DeleteSectionResponse
    {
        return new DeleteSectionResponse($done);
    }
}
