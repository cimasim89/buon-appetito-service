<?php

namespace App\Item\Infrastructure\Repository;

use App\Entity\Item;
use App\Item\Domain\Repository\ItemRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Item|null find($id, $lockMode = null, $lockVersion = null)
 * @method Item|null findOneBy(array $criteria, array $orderBy = null)
 * @method Item[]    findAll()
 * @method Item[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SqlItemRepository extends ServiceEntityRepository implements ItemRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Item::class);
    }

    public function saveItem(\App\Item\Domain\Item $item): \App\Item\Domain\Item
    {
        $ref = new Item();
        $ref->setId($item->getId())
            ->setName($item->getName())
            ->setPrice($item->getPrice())
            ->setSectionId($item->getSectionId());
        $this->getEntityManager()->persist($ref);
        $this->getEntityManager()->flush();
        return $item;
    }

    public function findBySectionId(string $sectionId): array
    {
        return array_map(function ($ref) {
            return \App\Item\Domain\Item::create(
                $ref->getId(),
                $ref->getName(),
                $ref->getPrice(),
                $ref->getSectionId()
            );
        }, $this->findBy(['section_id' => $sectionId]));
    }

    public function deleteItem(string $itemId)
    {
        $ref = $this->find($itemId);
        $this->getEntityManager()->remove($ref);
        $this->getEntityManager()->flush();
    }

    public function modifyItem(string $itemId, array $data): \App\Item\Domain\Item
    {
        $ref = $this->find($itemId);
        if (!is_null($data["name"])) {
            $ref->setName($data["name"]);
        }
        if (!is_null($data["price"])) {
            $ref->setPrice($data["price"]);
        }
        $this->getEntityManager()->persist($ref);
        $this->getEntityManager()->flush();

        return \App\Item\Domain\Item::create(
            $ref->getId(),
            $ref->getName(),
            $ref->getPrice(),
            $ref->getSectionId()
        );
    }

    public function deleteItemsBySectionId(string $sectionId)
    {
        $builder = $this->createQueryBuilder('items');
        $builder->delete()
            ->where('items.section_id =:id')
            ->setParameter(
                ':id',
                $sectionId
            );

        $query = $builder->getQuery();
        $query->execute();
    }
}
