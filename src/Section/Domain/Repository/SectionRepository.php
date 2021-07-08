<?php

namespace App\Section\Domain\Repository;

use App\Section\Domain\Section;

interface SectionRepository
{
    public function deleteSection(string $sectionId);
    public function findAll();
    public function findByActivityId(string $activityId): array;
    public function saveSection(Section $section): Section;
}
