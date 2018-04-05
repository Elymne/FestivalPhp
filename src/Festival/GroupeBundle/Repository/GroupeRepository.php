<?php

namespace Festival\GroupeBundle\Repository;

/**
 * GroupeRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class GroupeRepository extends \Doctrine\ORM\EntityRepository
{
    public function getAllGroupe()
    {
	return $this
            ->createQueryBuilder('m')
            ->getQuery()
            ->getResult()
	;
    }

    public function getOneById($id)
    {
	$qb = $this->createQueryBuilder('m');

	$qb
            ->where('m.id = :id')
            ->setParameter('id', $id)
	;

	return $qb
            ->getQuery()
            ->getResult()
	;
    }
    
    public function getOneByName($nom)
    {
	$qb = $this->createQueryBuilder('m');

	$qb
            ->where('m.nom = :nom')
            ->setParameter('nom', $nom)
	;

	return $qb
            ->getQuery()
            ->getResult()
	;
    }
}
