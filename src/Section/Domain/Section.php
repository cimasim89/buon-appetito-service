<?php

namespace App\Section\Domain;

class Section
{
    private $id;
    private $name;
    private $sequence;
    private $activityId;

    private function __construct(string $id, string $name, int $sequence, string $activityId)
    {
        $this->id = $id;
        $this->name = $name;
        $this->sequence = $sequence;
        $this->activityId = $activityId;
    }

    public static function create(
        string $id,
        string $name,
        int $sequence,
        string $activityId
    ): Section {
        return new Section($id, $name, $sequence, $activityId);
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getSequence(): int
    {
        return $this->sequence;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getActivityId(): string
    {
        return $this->activityId;
    }
}
