<?php

namespace AnnonceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * package
 *
 * @ORM\Table(name="package")
 * @ORM\Entity(repositoryClass="AnnonceBundle\Repository\packageRepository")
 */
class package
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
     * @ORM\Column(name="nomPackage", type="string", length=150, unique=true)
     */
    private $nomPackage;

    /**
     * @var float
     *
     * @ORM\Column(name="montant", type="float")
     */
    private $montant;

    /**
     * @var string
     *
     * @ORM\Column(name="devise", type="string", length=255, unique=false)
     */
    private $devise;

    /**
     * @var string
     *
     * @ORM\Column(name="nombreJours", type="string", length=255)
     */
    private $nombreJours;

    /**
     * @var string
     *
     * @ORM\Column(name="nombrePhotos", type="string", length=255)
     */
    private $nombrePhotos;

    /**
     *
     * @ORM\OneToMany(targetEntity="AnnonceBundle\Entity\Annonce", mappedBy="package", orphanRemoval=true)
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
     * Set nomPackage
     *
     * @param string $nomPackage
     *
     * @return package
     */
    public function setNomPackage($nomPackage)
    {
        $this->nomPackage = $nomPackage;

        return $this;
    }

    /**
     * Get nomPackage
     *
     * @return string
     */
    public function getNomPackage()
    {
        return $this->nomPackage;
    }

    /**
     * Set montant
     *
     * @param float $montant
     *
     * @return package
     */
    public function setMontant($montant)
    {
        $this->montant = $montant;

        return $this;
    }

    /**
     * Get montant
     *
     * @return float
     */
    public function getMontant()
    {
        return $this->montant;
    }

    /**
     * Set devise
     *
     * @param string $devise
     *
     * @return package
     */
    public function setDevise($devise)
    {
        $this->devise = $devise;

        return $this;
    }

    /**
     * Get devise
     *
     * @return string
     */
    public function getDevise()
    {
        return $this->devise;
    }

    /**
     * Set nombreJours
     *
     * @param string $nombreJours
     *
     * @return package
     */
    public function setNombreJours($nombreJours)
    {
        $this->nombreJours = $nombreJours;

        return $this;
    }

    /**
     * Get nombreJours
     *
     * @return string
     */
    public function getNombreJours()
    {
        return $this->nombreJours;
    }

    /**
     * Set nombrePhotos
     *
     * @param string $nombrePhotos
     *
     * @return package
     */
    public function setNombrePhotos($nombrePhotos)
    {
        $this->nombrePhotos = $nombrePhotos;

        return $this;
    }

    /**
     * Get nombrePhotos
     *
     * @return string
     */
    public function getNombrePhotos()
    {
        return $this->nombrePhotos;
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
     * @return package
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
        return $this->getNomPackage();
    }
}
