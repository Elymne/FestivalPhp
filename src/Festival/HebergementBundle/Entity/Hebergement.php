<?php

namespace Festival\HebergementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

/**
 * Hebergement
 *
 * @ORM\Table(name="hebergement")
 * @ORM\Entity(repositoryClass="Festival\HebergementBundle\Repository\HebergementRepository")
 */
class Hebergement
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
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date")
     * @Assert\Range(
     *      min = "now",
     *      max = "+1 year"
     * )
     */
    private $date;
    
    /**
    * @ORM\Column(name="updated_at", type="datetime", nullable=true)
    */
    private $updatedAt;
    
    public function __construct()
    {
        $this->date = new \Datetime();
    }
    
    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Hebergement
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
    * @ORM\PreUpdate
    */
    public function updateDate()
    {
        $this->setUpdatedAt(new \Datetime());
    }
    
    /**
     * @ORM\OneToOne(targetEntity="Festival\EtablissementBundle\Entity\Chambre")
     * @ORM\JoinColumn(nullable=false)
     */
    private $chambre;
    
    /**
     * @ORM\OneToOne(targetEntity="Festival\GroupeBundle\Entity\Groupe")
     * @ORM\JoinColumn(nullable=false)
     */
    private $groupe;


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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Hebergement
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }
    
    /**
     * Set chambre
     *
     * @param \Festival\EtablissementBundle\Entity\Chambre $chambre
     *
     * @return Chambre
     */
    public function setChambre(\Festival\EtablissementBundle\Entity\Chambre $chambre)
    {
        $this->chambre = $chambre;

        return $this;
    }

    /**
     * Get chambre
     *
     * @return \Festival\EtablissementBundle\Entity\Chambre
     */
    public function getChambre()
    {
        return $this->chambre;
    }
    
    /**
     * Set groupe
     *
     * @param \Festival\GroupeBundle\Entity\Groupe $groupe
     *
     * @return groupe
     */
    public function setGroupe(\Festival\GroupeBundle\Entity\Groupe $groupe)
    {
        $this->groupe = $groupe;

        return $this;
    }

    /**
     * Get groupe
     *
     * @return \Festival\GroupeBundle\Entity\Groupe
     */
    public function getGroupe()
    {
        return $this->groupe;
    }
    
    /**
     * @Assert\Callback
     */
    public function validate(ExecutionContextInterface $context, $payload)
    {   
        $nbLits = $this->getChambre()->getNbPlaces();
        $nbMembres = $this->getGroupe()->getNbPersonnes();
        
        if ($nbLits < $nbMembres) {
            $context->buildViolation("La chambre ne contient pas assez de lit pour ce groupe")
                ->atPath('groupe')
                ->addViolation();
        }
    }
}