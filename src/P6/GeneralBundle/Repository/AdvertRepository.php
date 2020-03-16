<?php

namespace P6\GeneralBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use P6\GeneralBundle\Entity\Advert;
use P6\GeneralBundle\Entity\AdvertSearch;

/**
 * AdvertRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class AdvertRepository extends EntityRepository
{
    private function findAllQuery(): QueryBuilder
    {
        return $this->createQueryBuilder('a');
    }

    /**
     * @param AdvertSearch $search
     * @return Advert[]
     */
    public function findAllAdvert(AdvertSearch $search): array
    {
        $query = $this->findAllQuery();

        if ($search->getUserRole()) {
            $query = $query
                ->andWhere('a.userRole = :userrole')
                ->setParameter('userrole', $search->getUserRole());
        }

        if ($search->getCategory()) {
            $query = $query
                ->andWhere('a.category = :category')
                ->setParameter('category', $search->getCategory());
        }

        if ($search->getPlace()) {
            $query = $query
                ->andWhere('a.place = :place')
                ->setParameter('place', $search->getPlace());
        }

        return $query
            ->orderBy('a.id', 'DESC')
            ->getQuery()
            ->getResult();
    }

    /**
     * @return Advert[]
     */
    public function findLatestAdvert(): array
    {
        $query = $this->findAllQuery();

        // sélection des 6 dernières annonces décroissantes : 7-6-5-4-3-2
        // mais affichage croissant (pour le bon défilement du slider: [5:1]->[:1]) dans la vue index.html.twig : 2-3-4-5-6-7
        return $query->orderBy('a.id', 'DESC')
            ->setMaxResults(6)
            ->getQuery()
            ->getResult();
    }

    public function getAdvertNumberByUser($user)
    {
        $queryBuilder = $this
            ->createQueryBuilder('advertNumber')
            ->select('COUNT(advertNumber)')
            ->where('advertNumber.userId= :user')
            ->setParameter('user', $user);

        return $queryBuilder
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function getAdvertByUser($user)
    {
        $queryBuilder = $this
            ->createQueryBuilder('advertUser')
            ->select('advertUser')
            ->where('advertUser.userId= :user')
            ->setParameter('user', $user);

        return $queryBuilder
            ->orderBy('advertUser.id', 'DESC')
            ->getQuery()
            ->getResult();
    }

}
