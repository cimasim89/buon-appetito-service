<?php

namespace App\Item\Application\DTO;

class DeleteItemResponse
{

    public $done;

    public function __construct(bool $done)
    {
        $this->done = $done;
    }

    public static function create(bool $done): DeleteItemResponse
    {
        return new DeleteItemResponse($done);
    }
}
