<?php

namespace Festival\EtablissementBundle\Repository;

/**
 * EtablissementRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class EtablissementRepository extends \Doctrine\ORM\EntityRepository
{
    
    public function getAllEtablissement()
    {
	return $this
            ->createQueryBuilder('e')
            ->getQuery()
            ->getResult()
	;
    }
    
}
