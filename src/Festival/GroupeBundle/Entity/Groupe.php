<?php

namespace Festival\GroupeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Groupe
 *
 * @ORM\Table(name="groupe")
 * @ORM\Entity(repositoryClass="Festival\GroupeBundle\Repository\GroupeRepository")
 * @UniqueEntity(fields="nom", message="Un groupe du même nom existe déjà")
 */
class Groupe
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
     * @ORM\Column(name="nom", type="string", length=40)
     * @Assert\Length(min=2, minMessage="Le nom du groupe doit faire au moins {{ limit }} caractères.")
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="responsable", type="string", length=40)
     * @Assert\Length(min=2, minMessage="Le nom du responsable doit faire au moins {{ limit }} caractères.")
     */
    private $responsable;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=40)
     * @Assert\Length(min=5, minMessage="Le nom de l'adresse doit faire au moins {{ limit }} caractères.")
     */
    private $adresse;

    /**
     * @var int
     *
     * @ORM\Column(name="nbPersonnes", type="smallint")
     * @Assert\Range(
     *      min = 1,
     *      max = 12,
     *      minMessage = "Il doit y avoir au moins  {{ limit }} membre dans le groupe",
     *      maxMessage = "Nous n'acceptons pas d'orchestre (La limite est de {{ limit }} membres",
     *)
     */
    private $nbPersonnes;

    /**
     * @var string
     *
     * @ORM\Column(name="pays", type="string", length=100)
     * @Assert\Length(min=5, minMessage="Le nom du pays {{ limit }} caractères.")
     */
    private $pays;

    /**
     * @var bool
     *
     * @ORM\Column(name="hebergement", type="boolean")
     */
    private $hebergement;


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
     * Set nom
     *
     * @param string $nom
     *
     * @return Groupe
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set responsable
     *
     * @param string $responsable
     *
     * @return Groupe
     */
    public function setResponsable($responsable)
    {
        $this->responsable = $responsable;

        return $this;
    }

    /**
     * Get responsable
     *
     * @return string
     */
    public function getResponsable()
    {
        return $this->responsable;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     *
     * @return Groupe
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set nbPersonnes
     *
     * @param integer $nbPersonnes
     *
     * @return Groupe
     */
    public function setNbPersonnes($nbPersonnes)
    {
        $this->nbPersonnes = $nbPersonnes;

        return $this;
    }

    /**
     * Get nbPersonnes
     *
     * @return int
     */
    public function getNbPersonnes()
    {
        return $this->nbPersonnes;
    }

    /**
     * Set pays
     *
     * @param string $pays
     *
     * @return Groupe
     */
    public function setPays($pays)
    {
        $this->pays = $pays;

        return $this;
    }

    /**
     * Get pays
     *
     * @return string
     */
    public function getPays()
    {
        return $this->pays;
    }

    /**
     * Set hebergement
     *
     * @param boolean $hebergement
     *
     * @return Groupe
     */
    public function setHebergement($hebergement)
    {
        $this->hebergement = $hebergement;

        return $this;
    }

    /**
     * Get hebergement
     *
     * @return bool
     */
    public function getHebergement()
    {
        return $this->hebergement;
    }
}

