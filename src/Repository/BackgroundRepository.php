<?php

namespace App\Repository;

use App\Entity\Background;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Background|null find($id, $lockMode = null, $lockVersion = null)
 * @method Background|null findOneBy(array $criteria, array $orderBy = null)
 * @method Background[]    findAll()
 * @method Background[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BackgroundRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Background::class);
    }

    /**
     * @param $searchQuery
     * @param $nsfw
     * @return Background[]
     */
    public function fetchFromParameters($searchQuery, $nsfw)
    {
        $queryBuilder = $this->createQueryBuilder('t');

        $queryBuilder->select('t');

        if (!$nsfw) {
            $queryBuilder->where('t.nsfw = 0');
        }

        if (strlen($searchQuery) > 0) {
            $queryBuilder->setParameter('query', '%' .  $searchQuery . '%');

            if (!$nsfw) {
                $queryBuilder->andWhere('t.title LIKE :query');

                return $queryBuilder->getQuery()->getResult();
            }

            $queryBuilder->where('t.title LIKE :query');

            return $queryBuilder->getQuery()->getResult();
        }

        return $queryBuilder->getQuery()->getResult();
    }
}
