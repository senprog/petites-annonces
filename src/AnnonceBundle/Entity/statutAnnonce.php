<?php

namespace AnnonceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * statutAnnonce
 *
 * @ORM\Table(name="statut_annonce")
 * @ORM\Entity(repositoryClass="AnnonceBundle\Repository\statutAnnonceRepository")
 */
class statutAnnonce
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
     * @ORM\Column(name="nom", type="string", length=200, unique=true)
     */
    private $nom;

    /**
     *
     * @ORM\OneToMany(targetEntity="AnnonceBundle\Entity\Annonce", mappedBy="statutAnnonce", orphanRemoval=true)
     */
    private $annonce;


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
     * @return statutAnnonce
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
     * Constructor
     */
    public function __construct()
    {
        $this->annonce = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add annonce
     *
     * @param \AnnonceBundle\Entity\Annonce $annonce
     *
     * @return statutAnnonce
     */
    public function addAnnonce(\AnnonceBundle\Entity\Annonce $annonce)
    {
        $this->annonce[] = $annonce;

        return $this;
    }

    /**
     * Remove annonce
     *
     * @param \AnnonceBundle\Entity\Annonce $annonce
     */
    public function removeAnnonce(\AnnonceBundle\Entity\Annonce $annonce)
    {
        $this->annonce->removeElement($annonce);
    }

    /**
     * Get annonce
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAnnonce()
    {
        return $this->annonce;
    }

    public function __toString()
    {
        return $this->getNom();
    }
}
