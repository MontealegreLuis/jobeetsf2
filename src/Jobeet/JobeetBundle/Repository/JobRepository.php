<?php
namespace Jobeet\JobeetBundle\Repository;

use Doctrine\ORM\EntityRepository;

class JobRepository extends EntityRepository
{
    public function findLatestActiveJobs()
    {
        $qb = $this->createQueryBuilder('j');
        $qb->where('j.isActivated = 1');
        $qb->innerJoin('j.category', 'c');
        $qb->orderBy('c.name', 'ASC');
        $qb->addOrderBy('j.created', 'DESC');

        return $qb->getQuery()->getResult();
    }
}