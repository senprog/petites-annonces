<?php

namespace AnnonceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * profilAnnonceur
 *
 * @ORM\Table(name="profil_annonceur")
 * @ORM\Entity(repositoryClass="AnnonceBundle\Repository\profilAnnonceurRepository")
 */
class profilAnnonceur
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
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255, nullable=false, unique=true)
     */
    private $nom;

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return profilAnnonceur
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

    public function __toString()
    {
        // TODO: Implement __toString() method.
        return $this->nom;
    }
}
