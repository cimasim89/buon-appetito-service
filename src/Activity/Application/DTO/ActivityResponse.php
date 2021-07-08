<?php

namespace App\Activity\Application\DTO;

use App\Activity\Domain\Activity;

class ActivityResponse
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
     * @var string
     */
    public $description;
    /**
     * @var string
     */
    public $email;

    public function __construct(string $id, string $name, string $description, string $email)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->email = $email;
    }

    public static function createFromActivity(Activity $activity): ActivityResponse
    {
        return new ActivityResponse(
            $activity->getId(),
            $activity->getName(),
            $activity->getDescription(),
            $activity->getEmail()
        );
    }
}
