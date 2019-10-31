<?php

namespace AppBundle\Repository;

/**
 * UserRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class UserRepository extends \Doctrine\ORM\EntityRepository
{
    public function findDisabledUsers() {
        return $this->$this->getEntityManager()
            ->createQuery(
                'SELECT * FROM AppBundle:User WHERE User.enabled=0'
            )
            ->getResult();
    }
}
