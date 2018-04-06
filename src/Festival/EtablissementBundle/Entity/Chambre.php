<?php

namespace Festival\EtablissementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Chambre
 *
 * @ORM\Table(name="chambre")
 * @ORM\Entity(repositoryClass="Festival\EtablissementBundle\Repository\ChambreRepository")
 */
class Chambre
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nomChambre", type="string", length=10)
     */
    private $nomChambre;

    /**
     * @var int
     *
     * @ORM\Column(name="nbPlaces", type="integer")
     */
    private $nbPlaces;

    /**
     * @ORM\ManyToOne(targetEntity="Festival\EtablissementBundle\Entity\Etablissement")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idEtablissement;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nomChambre
     *
     * @param string $nomChambre
     *
     * @return Chambre
     */
    public function setNomChambre($nomChambre)
    {
        $this->nomChambre = $nomChambre;

        return $this;
    }

    /**
     * Get nomChambre
     *
     * @return string
     */
    public function getNomChambre()
    {
        return $this->nomChambre;
    }

    /**
     * Set nbPlaces
     *
     * @param integer $nbPlaces
     *
     * @return Chambre
     */
    public function setNbPlaces($nbPlaces)
    {
        $this->nbPlaces = $nbPlaces;

        return $this;
    }

    /**
     * Get nbPlaces
     *
     * @return int
     */
    public function getNbPlaces()
    {
        return $this->nbPlaces;
    }

    /**
     * Set idEtablissement
     *
     * @param \Festival\EtablissementBundle\Entity\Etablissement $Etablissement
     *
     * @return Chambre
     */
    public function setidEtablissement(\Festival\EtablissementBundle\Entity\Etablissement $idEtablissement)
    {
        $this->idEtablissement = $idEtablissement;

        return $this;
    }

    /**
     * Get Etablissement
     *
     * @return \Festival\EtablissementBundle\Entity\Etablissement
     */
    public function getidEtablissement()
    {
        return $this->idEtablissement;
    }
}

