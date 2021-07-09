<?php

namespace App\Item\Application\DTO;

class GetItemBySectionIdQuery
{

    /**
     * @var string
     */
    public $sectionId;

    public function __construct(string $sectionId)
    {
        $this->sectionId = $sectionId;
    }

    public static function create(string $sectionId): GetItemBySectionIdQuery
    {
        return new GetItemBySectionIdQuery($sectionId);
    }
}
