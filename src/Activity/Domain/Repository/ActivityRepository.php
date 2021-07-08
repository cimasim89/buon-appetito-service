<?php

namespace App\Activity\Domain\Repository;

use App\Activity\Domain\Activity;
use App\Activity\Domain\Exceptions\ActivityNotFoundException;

interface ActivityRepository
{
    /**
     * @param string $email
     * @throws ActivityNotFoundException
     * @return Activity
     */
    public function getActivityByEmail(string $email): Activity;
    public function saveActivity(Activity $activity): Activity;
    public function findAll();
}
