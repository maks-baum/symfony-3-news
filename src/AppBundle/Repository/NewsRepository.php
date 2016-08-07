<?php

namespace AppBundle\Repository;

use Doctrine\ORM\QueryBuilder;

/**
 * NewsRepository
 */
class NewsRepository extends BaseRepository
{
    /**
     * @return \Doctrine\ORM\QueryBuilder
     */
    protected function getBaseQueryBuilderWithJoins():QueryBuilder
    {
        return $this->createQueryBuilder(self::NEWS_ALIAS)
            ->select([self::NEWS_ALIAS, self::AUTHOR_ALIAS, self::CATEGORY_ALIAS, self::TAG_ALIAS])
            ->leftJoin(sprintf('%s.author', self::NEWS_ALIAS), self::AUTHOR_ALIAS)
            ->leftJoin(sprintf('%s.category', self::NEWS_ALIAS), self::CATEGORY_ALIAS)
            ->leftJoin(sprintf('%s.tags', self::NEWS_ALIAS), self::TAG_ALIAS);
    }

    /**
     * @return array
     */
    public function findAllWithJoins():array
    {
        return $this->getBaseQueryBuilderWithJoins()
            ->getQuery()
            ->getResult();
    }

    /**
     * @param int $id
     * @return mixed
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findOneByIdWithJoins(int $id)
    {
        return $this->getBaseQueryBuilderWithJoins()
            ->andWhere(sprintf('%s.id = :id', self::NEWS_ALIAS))
            ->setParameter('id', $id)
            ->getQuery()
            ->getSingleResult();
    }

    /**
     * @param string $slug
     * @return mixed
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findOneBySlugWithJoins(string $slug)
    {
        return $this->getBaseQueryBuilderWithJoins()
            ->andWhere(sprintf('%s.slug = :slug', self::NEWS_ALIAS))
            ->setParameter('slug', $slug)
            ->getQuery()
            ->getSingleResult();
    }

}
