<?php

namespace Festival\EtablissementBundle\Repository;

/**
 * ChambreRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ChambreRepository extends \Doctrine\ORM\EntityRepository
{
    
    public function getAllChambre()
    {
	return $this
            ->createQueryBuilder('c')
            ->getQuery()
            ->getResult()
	;
    }
}