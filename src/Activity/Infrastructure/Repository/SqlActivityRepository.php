<?php

namespace App\Activity\Infrastructure\Repository;

use App\Activity\Domain\Exceptions\ActivityNotFoundException;
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

    /**
     * @throws ActivityNotFoundException
     */
    public function getActivityByEmail(string $email): \App\Activity\Domain\Activity
    {
        $ref = $this->findOneBy([
            'email' => $email,
        ]);
        if (!$ref) {
            throw new ActivityNotFoundException("Activity not found");
        }
        return \App\Activity\Domain\Activity::create(
            $ref->getId(),
            $ref->getName(),
            $ref->getDescription(),
            $ref->getEmail(),
            $ref->getPassword()
        );
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
        return $this->findOneBy(['email' => $email]);
    }

    /**
     * @throws ActivityNotFoundException
     */
    public function getActivityById(string $activityId): \App\Activity\Domain\Activity
    {
        $ref = $this->find($activityId);
        if (!$ref) {
            throw new ActivityNotFoundException("Activity not found");
        }
        return \App\Activity\Domain\Activity::create(
            $ref->getId(),
            $ref->getName(),
            $ref->getDescription(),
            $ref->getEmail(),
            $ref->getPassword()
        );
    }
}
