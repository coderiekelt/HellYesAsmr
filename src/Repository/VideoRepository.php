<?php

namespace App\Repository;

use App\Entity\Video;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Video|null find($id, $lockMode = null, $lockVersion = null)
 * @method Video|null findOneBy(array $criteria, array $orderBy = null)
 * @method Video[]    findAll()
 * @method Video[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VideoRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Video::class);
    }

    /**
     * @param $searchQuery
     * @param $nsfw
     * @return Video[]
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
