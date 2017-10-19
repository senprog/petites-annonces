<?php

namespace AnnonceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Mykees\MediaBundle\Interfaces\Mediable;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Annonce
 *
 * @ORM\Table(name="annonce")
 * @ORM\Entity(repositoryClass="AnnonceBundle\Repository\AnnonceRepository")
 * @Vich\Uploadable
 */
class Annonce
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
     * @ORM\Column(name="titre", type="string", length=200)
     */
    private $titre;

    /**
     * @ORM\ManyToOne(targetEntity="AnnonceBundle\Entity\categorieAnnonce", inversedBy="annonce")
     */
    private $categorie;

    /**
     * @ORM\ManyToOne(targetEntity="AnnonceBundle\Entity\sousCategorieAnnonce", inversedBy="annonces")
     */
    private $sousCategorie;

    /**
     * @ORM\ManyToOne(targetEntity="AnnonceBundle\Entity\devise")
     */
    private $devise;

    /**
     * @var string
     *
     * @ORM\Column(name="prix", type="string", length=50, nullable=true)
     */
    private $prix;

    /**
     * @var string
     *
     * @ORM\Column(name="type_prix", type="text", nullable=true)
     */
    private $typePrix;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse_objet", type="string", length=255, nullable=true)
     */
    private $adresseObjetVendu;

    /**
     * @var string
     *
     * @ORM\Column(name="pays", type="string", length=255, nullable=true)
     */
    private $pays;

    /**
     * @var string
     *
     * @ORM\Column(name="departement", type="string", length=200, nullable=true)
     */
    private $departement;

    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string", length=255, nullable=true)
     */
    private $ville;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;


    /**
     * @var string
     *
     * @ORM\Column(name="googleMap", type="string", length=255, nullable=true)
     */
    private $googleMap;


    /**
     *
     * @ORM\ManyToOne(targetEntity="AnnonceBundle\Entity\statutAnnonce", inversedBy="annonce")
     */
    private $statutAnnonce;

    /**
     * @ORM\ManyToOne(targetEntity="AnnonceBundle\Entity\typeAnnonce", inversedBy="annonce")
     */
    private $typeAnnonce;

    /**
     * @ORM\ManyToOne(targetEntity="AnnonceBundle\Entity\package", inversedBy="annonce")
     */
    private $package;

    /**
     * @ORM\ManyToOne(targetEntity="AnnonceBundle\Entity\etatArticleAnnonce", inversedBy="annonce")
     */
    private $etatArticleAnnonce;

    /**
     * @ORM\OneToMany(targetEntity="AnnonceBundle\Entity\Document", mappedBy="annonce")
     * @ORM\JoinColumn(nullable=true)
     */
    private $document;

    /**
     * @var string
     *
     * @ORM\Column(name="photo3", type="string", length=255, nullable=true)
     */
    private $photo3;

    /**
     * @var string
     *
     * @ORM\Column(name="photo4", type="string", length=255, nullable=true)
     */
    private $photo4;

    /**
     * @var string
     *
     * @ORM\Column(name="photo5", type="string", length=255, nullable=true)
     */
    private $photo5;

    /**
     * @var string
     *
     * @ORM\Column(name="photo6", type="string", length=255, nullable=true)
     */
    private $photo6;

    /**
     * @var int
     *
     * @ORM\Column(name="nombreVue", type="integer")
     */
    private $nombreVue;

    /**
     * @ORM\Column(name="date_publication", type="datetime")
     */
    private $datePublication;

    /**
     * @ORM\Column(name="date_modification", type="datetime", nullable=true)
     */
    private $dateModification;

    /**
     * @ORM\Column(name="date_suppression", type="datetime", nullable=true)
     */
    private $dateSuppression;

    /**
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User", inversedBy="annonces")
     * @ORM\JoinColumn(nullable=true)
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="AnnonceBundle\Entity\Anonyme")
     * @ORM\JoinColumn(nullable=true)
     */
    private $anonyme;


    public function __construct()
    {
        $this->datePublication = new \DateTime();
        $this->nombreVue = 0;
    }

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
     * Set titre
     *
     * @param string $titre
     *
     * @return Annonce
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set prix
     *
     * @param float $prix
     *
     * @return Annonce
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get prix
     *
     * @return float
     */
    public function getPrix()
    {
        return $this->prix;
    }


    /**
     * Set description
     *
     * @param string $description
     *
     * @return Annonce
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set googleMap
     *
     * @param string $googleMap
     *
     * @return Annonce
     */
    public function setGoogleMap($googleMap)
    {
        $this->googleMap = $googleMap;

        return $this;
    }

    /**
     * Get googleMap
     *
     * @return string
     */
    public function getGoogleMap()
    {
        return $this->googleMap;
    }


    /**
     * Set nombreVue
     *
     * @param integer $nombreVue
     *
     * @return Annonce
     */
    public function setNombreVue($nombreVue)
    {
        $this->nombreVue = $nombreVue;

        return $this;
    }

    /**
     * Get nombreVue
     *
     * @return int
     */
    public function getNombreVue()
    {
        return $this->nombreVue;
    }

    /**
     * Set typePrix
     *
     * @param string $typePrix
     *
     * @return Annonce
     */
    public function setTypePrix($typePrix)
    {
        $this->typePrix = $typePrix;

        return $this;
    }

    /**
     * Get typePrix
     *
     * @return string
     */
    public function getTypePrix()
    {
        return $this->typePrix;
    }



    /**
     * Set categorie
     *
     * @param \AnnonceBundle\Entity\categorieAnnonce $categorie
     *
     * @return Annonce
     */
    public function setCategorie(\AnnonceBundle\Entity\categorieAnnonce $categorie = null)
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Get categorie
     *
     * @return \AnnonceBundle\Entity\categorieAnnonce
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * Set sousCategorie
     *
     * @param \AnnonceBundle\Entity\sousCategorieAnnonce $sousCategorie
     *
     * @return Annonce
     */
    public function setSousCategorie(\AnnonceBundle\Entity\sousCategorieAnnonce $sousCategorie = null)
    {
        $this->sousCategorie = $sousCategorie;

        return $this;
    }

    /**
     * Get sousCategorie
     *
     * @return \AnnonceBundle\Entity\sousCategorieAnnonce
     */
    public function getSousCategorie()
    {
        return $this->sousCategorie;
    }

    /**
     * Set statutAnnonce
     *
     * @param \AnnonceBundle\Entity\statutAnnonce $statutAnnonce
     *
     * @return Annonce
     */
    public function setStatutAnnonce(\AnnonceBundle\Entity\statutAnnonce $statutAnnonce = null)
    {
        $this->statutAnnonce = $statutAnnonce;

        return $this;
    }

    /**
     * Get statutAnnonce
     *
     * @return \AnnonceBundle\Entity\statutAnnonce
     */
    public function getStatutAnnonce()
    {
        return $this->statutAnnonce;
    }

    /**
     * Set typeAnnonce
     *
     * @param \AnnonceBundle\Entity\typeAnnonce $typeAnnonce
     *
     * @return Annonce
     */
    public function setTypeAnnonce(\AnnonceBundle\Entity\typeAnnonce $typeAnnonce = null)
    {
        $this->typeAnnonce = $typeAnnonce;

        return $this;
    }

    /**
     * Get typeAnnonce
     *
     * @return \AnnonceBundle\Entity\typeAnnonce
     */
    public function getTypeAnnonce()
    {
        return $this->typeAnnonce;
    }

    /**
     * Set package
     *
     * @param \AnnonceBundle\Entity\package $package
     *
     * @return Annonce
     */
    public function setPackage(\AnnonceBundle\Entity\package $package = null)
    {
        $this->package = $package;

        return $this;
    }

    /**
     * Get package
     *
     * @return \AnnonceBundle\Entity\package
     */
    public function getPackage()
    {
        return $this->package;
    }

    /**
     * Set etatArticleAnnonce
     *
     * @param \AnnonceBundle\Entity\etatArticleAnnonce $etatArticleAnnonce
     *
     * @return Annonce
     */
    public function setEtatArticleAnnonce(\AnnonceBundle\Entity\etatArticleAnnonce $etatArticleAnnonce = null)
    {
        $this->etatArticleAnnonce = $etatArticleAnnonce;

        return $this;
    }

    /**
     * Get etatArticleAnnonce
     *
     * @return \AnnonceBundle\Entity\etatArticleAnnonce
     */
    public function getEtatArticleAnnonce()
    {
        return $this->etatArticleAnnonce;
    }

    /**
     * Set user
     *
     * @param \UserBundle\Entity\User $user
     *
     * @return Annonce
     */
    public function setUser(\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set datePublication
     *
     * @param \DateTime $datePublication
     *
     * @return Annonce
     */
    public function setDatePublication($datePublication)
    {
        $this->datePublication = $datePublication;

        return $this;
    }

    /**
     * Get datePublication
     *
     * @return \DateTime
     */
    public function getDatePublication()
    {
        return $this->datePublication;
    }

    /**
     * Set dateModification
     *
     * @param \DateTime $dateModification
     *
     * @return Annonce
     */
    public function setDateModification($dateModification)
    {
        $this->dateModification = $dateModification;

        return $this;
    }

    /**
     * Get dateModification
     *
     * @return \DateTime
     */
    public function getDateModification()
    {
        return $this->dateModification;
    }

    /**
     * Set dateSuppression
     *
     * @param \DateTime $dateSuppression
     *
     * @return Annonce
     */
    public function setDateSuppression($dateSuppression)
    {
        $this->dateSuppression = $dateSuppression;

        return $this;
    }

    /**
     * Get dateSuppression
     *
     * @return \DateTime
     */
    public function getDateSuppression()
    {
        return $this->dateSuppression;
    }

    /**
     * Set anonyme
     *
     * @param \AnnonceBundle\Entity\Anonyme $anonyme
     *
     * @return Annonce
     */
    public function setAnonyme(\AnnonceBundle\Entity\Anonyme $anonyme = null)
    {
        $this->anonyme = $anonyme;

        return $this;
    }

    /**
     * Get anonyme
     *
     * @return \AnnonceBundle\Entity\Anonyme
     */
    public function getAnonyme()
    {
        return $this->anonyme;
    }

    /**
     * Set photo3
     *
     * @param string $photo3
     *
     * @return Annonce
     */
    public function setPhoto3($photo3)
    {
        $this->photo3 = $photo3;

        return $this;
    }

    /**
     * Get photo3
     *
     * @return string
     */
    public function getPhoto3()
    {
        return $this->photo3;
    }

    /**
     * Set photo4
     *
     * @param string $photo4
     *
     * @return Annonce
     */
    public function setPhoto4($photo4)
    {
        $this->photo4 = $photo4;

        return $this;
    }

    /**
     * Get photo4
     *
     * @return string
     */
    public function getPhoto4()
    {
        return $this->photo4;
    }

    /**
     * Set photo5
     *
     * @param string $photo5
     *
     * @return Annonce
     */
    public function setPhoto5($photo5)
    {
        $this->photo5 = $photo5;

        return $this;
    }

    /**
     * Get photo5
     *
     * @return string
     */
    public function getPhoto5()
    {
        return $this->photo5;
    }


    /**
     * Set devise
     *
     * @param \AnnonceBundle\Entity\devise $devise
     *
     * @return Annonce
     */
    public function setDevise(\AnnonceBundle\Entity\devise $devise = null)
    {
        $this->devise = $devise;

        return $this;
    }

    /**
     * Get devise
     *
     * @return \AnnonceBundle\Entity\devise
     */
    public function getDevise()
    {
        return $this->devise;
    }



    /**
     * Set pays
     *
     * @param string $pays
     *
     * @return Annonce
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
     * Set departement
     *
     * @param string $departement
     *
     * @return Annonce
     */
    public function setDepartement($departement)
    {
        $this->departement = $departement;

        return $this;
    }

    /**
     * Get departement
     *
     * @return string
     */
    public function getDepartement()
    {
        return $this->departement;
    }

    /**
     * Set ville
     *
     * @param string $ville
     *
     * @return Annonce
     */
    public function setVille($ville)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get ville
     *
     * @return string
     */
    public function getVille()
    {
        return $this->ville;
    }


    /**
     * Set photo6
     *
     * @param string $photo6
     *
     * @return Annonce
     */
    public function setPhoto6($photo6)
    {
        $this->photo6 = $photo6;

        return $this;
    }

    /**
     * Get photo6
     *
     * @return string
     */
    public function getPhoto6()
    {
        return $this->photo6;
    }

    /**
     * Set adresseObjetVendu
     *
     * @param string $adresseObjetVendu
     *
     * @return Annonce
     */
    public function setAdresseObjetVendu($adresseObjetVendu)
    {
        $this->adresseObjetVendu = $adresseObjetVendu;

        return $this;
    }

    /**
     * Get adresseObjetVendu
     *
     * @return string
     */
    public function getAdresseObjetVendu()
    {
        return $this->adresseObjetVendu;
    }

    /**
     * Add document
     *
     * @param \AnnonceBundle\Entity\Document $document
     *
     * @return Annonce
     */
    public function addDocument(\AnnonceBundle\Entity\Document $document)
    {
        $this->document[] = $document;

        return $this;
    }

    /**
     * Remove document
     *
     * @param \AnnonceBundle\Entity\Document $document
     */
    public function removeDocument(\AnnonceBundle\Entity\Document $document)
    {
        $this->document->removeElement($document);
    }

    /**
     * Get document
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDocument()
    {
        return $this->document;
    }
}
