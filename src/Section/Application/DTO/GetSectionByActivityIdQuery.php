<?php

namespace App\Section\Application\DTO;

class GetSectionByActivityIdQuery
{

    /**
     * @var string
     */
    public $activityId;

    public function __construct(string $activityId)
    {
        $this->activityId = $activityId;
    }

    public static function create(string $activityId): GetSectionByActivityIdQuery
    {
        return new GetSectionByActivityIdQuery($activityId);
    }
}
