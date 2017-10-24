<?php

namespace AnnonceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * categorieAnnonce
 *
 * @ORM\Table(name="categorie_annonce")
 * @ORM\Entity(repositoryClass="AnnonceBundle\Repository\categorieAnnonceRepository")
 */
class categorieAnnonce
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
     * @var string
     *
     * @ORM\Column(name="class", type="string", length=200, nullable=true)
     */
    private $class;

    /**
     * @var string
     *
     * @ORM\Column(name="icon", type="string", length=100, nullable=true)
     */
    private $icon;

    /**
     * @var string
     *
     * @ORM\Column(name="icon_mini", type="string", length=100, nullable=true)
     */
    private $iconMini;

    /**
     * @var string
     *
     * @ORM\OneToMany(targetEntity="AnnonceBundle\Entity\sousCategorieAnnonce", mappedBy="nomCategorie", orphanRemoval=true)
     */
    private $sousCategorie;

    /**
     * @var string
     *
     * @ORM\OneToMany(targetEntity="AnnonceBundle\Entity\Annonce", mappedBy="categorie", orphanRemoval=true)
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
     * @return categorieAnnonce
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
        $this->sousCategorie = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set class
     *
     * @param string $class
     *
     * @return categorieAnnonce
     */
    public function setClass($class)
    {
        $this->class = $class;

        return $this;
    }

    /**
     * Get class
     *
     * @return string
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * Set icon
     *
     * @param string $icon
     *
     * @return categorieAnnonce
     */
    public function setIcon($icon)
    {
        $this->icon = $icon;

        return $this;
    }

    /**
     * Get icon
     *
     * @return string
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * Add sousCategorie
     *
     * @param \AnnonceBundle\Entity\sousCategorieAnnonce $sousCategorie
     *
     * @return categorieAnnonce
     */
    public function addSousCategorie(\AnnonceBundle\Entity\sousCategorieAnnonce $sousCategorie)
    {
        $this->sousCategorie[] = $sousCategorie;

        return $this;
    }

    /**
     * Remove sousCategorie
     *
     * @param \AnnonceBundle\Entity\sousCategorieAnnonce $sousCategorie
     */
    public function removeSousCategorie(\AnnonceBundle\Entity\sousCategorieAnnonce $sousCategorie)
    {
        $this->sousCategorie->removeElement($sousCategorie);
    }

    /**
     * Get sousCategorie
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSousCategorie()
    {
        return $this->sousCategorie;
    }

    public function __toString()
    {
        return $this->getNom();
    }

    /**
     * Set iconMini
     *
     * @param string $iconMini
     *
     * @return categorieAnnonce
     */
    public function setIconMini($iconMini)
    {
        $this->iconMini = $iconMini;

        return $this;
    }

    /**
     * Get iconMini
     *
     * @return string
     */
    public function getIconMini()
    {
        return $this->iconMini;
    }

    /**
     * Add annonce
     *
     * @param \AnnonceBundle\Entity\Annonce $annonce
     *
     * @return categorieAnnonce
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
}
