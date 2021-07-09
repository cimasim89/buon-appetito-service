<?php

namespace App\Section\Application\DTO;

use App\Section\Domain\Section;

class GetSectionByActivityIdResponse
{

    /**
     * @var string
     */
    public $id;
    /**
     * @var string
     */
    public $name;
    /**
     * @var int
     */
    public $sequence;
    /**
     * @var string
     */
    public $activityId;

    private function __construct(string $id, string $name, int $sequence, string $activityId)
    {
        $this->id = $id;
        $this->name = $name;
        $this->sequence = $sequence;
        $this->activityId = $activityId;
    }

    public static function createFromSection(Section $section): GetSectionByActivityIdResponse
    {
        return new GetSectionByActivityIdResponse(
            $section->getId(),
            $section->getName(),
            $section->getSequence(),
            $section->getActivityId()
        );
    }
}
