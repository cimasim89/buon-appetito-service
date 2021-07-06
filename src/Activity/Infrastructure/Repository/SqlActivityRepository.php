<?php

namespace App\Activity\Infrastructure\Repository;

use App\Activity\Domain\Repository\ActivityRepository;
use App\Entity\Activity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Activity|null find($id, $lockMode = null, $lockVersion = null)
 * @method Activity|null findOneBy(array $criteria, array $orderBy = null)
 * @method Activity[]    findAll()
 * @method Activity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SqlActivityRepository extends ServiceEntityRepository implements ActivityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Activity::class);
    }

    public function saveActivity(\App\Activity\Domain\Activity $activity): \App\Activity\Domain\Activity
    {
        $ref = new Activity();
        $ref->setId($activity->getId());
        $ref->setDescription($activity->getDescription());
        $ref->setPassword($activity->getPassword());
        $ref->setName($activity->getName());
        $ref->setEmail($activity->getEmail());
        $this->getEntityManager()->persist($ref);
        $this->getEntityManager()->flush();
        return $activity;
    }
}
