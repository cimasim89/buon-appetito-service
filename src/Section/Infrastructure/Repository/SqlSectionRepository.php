<?php

namespace App\Section\Infrastructure\Repository;

use App\Entity\Section;
use App\Section\Domain\Repository\SectionRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Section|null find($id, $lockMode = null, $lockVersion = null)
 * @method Section|null findOneBy(array $criteria, array $orderBy = null)
 * @method Section[]    findAll()
 * @method Section[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SqlSectionRepository extends ServiceEntityRepository implements SectionRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Section::class);
    }

    public function saveSection(\App\Section\Domain\Section $section): \App\Section\Domain\Section
    {
        $ref = new Section();
        $ref->setId($section->getId())
            ->setName($section->getName())
            ->setSequence($section->getSequence())
            ->setActivityId($section->getActivityId());
        print_r($ref);
        $this->getEntityManager()->persist($ref);
        $this->getEntityManager()->flush();
        return $section;
    }

    public function findByActivityId(string $activityId): array
    {
        return array_map(function ($ref) {
            return \App\Section\Domain\Section::create(
                $ref->getId(),
                $ref->getName(),
                $ref->getSequence(),
                $ref->getActivityId()
            );
        }, $this->findBy(['activity_id' => $activityId]));
    }

    public function deleteSection(string $sectionId)
    {
        $ref = $this->find($sectionId);
        $this->getEntityManager()->remove($ref);
        $this->getEntityManager()->flush();
    }
}
