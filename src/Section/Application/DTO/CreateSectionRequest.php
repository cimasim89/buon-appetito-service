<?php

namespace App\Section\Application\DTO;

class CreateSectionRequest
{

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

    public function __construct(string $name, int $sequence, string $activityId)
    {
        $this->name = $name;
        $this->sequence = $sequence;
        $this->activityId = $activityId;
    }

    public static function create(array $data): CreateSectionRequest
    {
        return new CreateSectionRequest(
            $data["name"],
            $data["sequence"],
            $data["activityId"]
        );
    }
}
