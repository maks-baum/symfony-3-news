<?php
namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class BaseRepository extends EntityRepository
{
    const
        AUTHOR_ALIAS = 'a',
        CATEGORY_ALIAS = 'c',
        NEWS_ALIAS = 'n',
        TAG_ALIAS = 't';
}