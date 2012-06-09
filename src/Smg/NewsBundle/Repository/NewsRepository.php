<?php

namespace Smg\NewsBundle\Repository;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\EntityRepository;

class NewsRepository extends EntityRepository {

    public function findAllOrderedByDate($limit = null)
    {
        $qb = $this->createQueryBuilder('news')
                   ->select('news')
                   ->addOrderBy('news.created', 'DESC');
    
        if ($limit != null)
            $qb->setMaxResults($limit);
    
        return $qb->getQuery()
                  ->getResult();
    }
}