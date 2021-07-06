<?php

namespace App\Activity\Domain\Repository;

use App\Activity\Domain\Activity;

interface ActivityRepository
{
    public function saveActivity(Activity $activity): Activity;
    public function findAll();
}
