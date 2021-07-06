<?php

namespace App\Activity\Infrastructure\Repository;

use App\Activity\Domain\Repository\ActivityRepository;
use App\Entity\Activity;
use App\Services\PasswordHashService;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;

/**
 * @method Activity|null find($id, $lockMode = null, $lockVersion = null)
 * @method Activity|null findOneBy(array $criteria, array $orderBy = null)
 * @method Activity[]    findAll()
 * @method Activity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method null loadUserByIdentifier(string $identifier)
 */
class SqlActivityRepository extends ServiceEntityRepository implements ActivityRepository, UserLoaderInterface
{
    /**
     * @var PasswordHashService
     */
    private $passwordHashService;

    public function __construct(ManagerRegistry $registry, PasswordHashService $passwordHashService)
    {
        parent::__construct($registry, Activity::class);
        $this->passwordHashService = $passwordHashService;
    }

    public function saveActivity(\App\Activity\Domain\Activity $activity): \App\Activity\Domain\Activity
    {
        $ref = new Activity();
        $ref->setId($activity->getId());
        $ref->setDescription($activity->getDescription());
        $ref->setPassword($this->passwordHashService->hashPassword($activity->getPassword()));
        $ref->setName($activity->getName());
        $ref->setEmail($activity->getEmail());
        $this->getEntityManager()->persist($ref);
        $this->getEntityManager()->flush();
        return $activity;
    }

    public function loadUserByUsername(string $email)
    {
        return $this->findOneBy(['email'=> $email]);
    }
}
