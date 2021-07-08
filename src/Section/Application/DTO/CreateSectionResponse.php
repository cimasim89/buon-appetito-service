<?php

namespace App\Section\Application\DTO;

use App\Section\Domain\Section;

class CreateSectionResponse
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

    public function __construct(string $id, string $name, int $sequence, string $activityId)
    {
        $this->id = $id;
        $this->name = $name;
        $this->sequence = $sequence;
        $this->activityId = $activityId;
    }

    public static function createFromSection(Section $section): CreateSectionResponse
    {
        return new CreateSectionResponse(
            $section->getId(),
            $section->getName(),
            $section->getSequence(),
            $section->getActivityId()
        );
    }
}
