<?php

namespace ZRR\CandidatureBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Candidat
 *
 * @ORM\Table(name="candidat")
 * @ORM\Entity(repositoryClass="ZRR\CandidatureBundle\Repository\CandidatRepository")
 */
class Candidat
{

    private $dossiertmp;

    /**
     * @return mixed
     */
    public function getDossiertmp()
    {
        return $this->dossiertmp;
    }

    /**
     * @param mixed $dossiertmp
     */
    public function setDossiertmp($dossiertmp)
    {
        $this->dossiertmp = $dossiertmp;
    }

    //inverse
    /**
     * @ORM\OneToOne(targetEntity="ZRR\UserBundle\Entity\User", mappedBy="candidat", cascade={"persist","remove"})
     */
    private $user;

    //propriétaire
    /**
     * @ORM\OneToOne(targetEntity="ZRR\CandidatureBundle\Entity\InfoCompl", cascade={"persist","remove"})
     */
    private $infoCompl;

    //proprietaire
    /**
     * @ORM\ManyToOne(targetEntity="ZRR\CandidatureBundle\Entity\Laboratoire")
     * @ORM\JoinColumn(nullable=true)
     */
    private $laboratoire;


    //inverse
    /**
     * @ORM\OneToMany(targetEntity="ZRR\CandidatureBundle\Entity\Dossier", mappedBy="candidat", cascade={"persist","remove"})
     */
    private $dossiers;


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
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=255)
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_marital", type="string", length=255, nullable=true)
     */
    private $nomMarital;

    /**
     * @var string
     *
     * @ORM\Column(name="sexe", type="string", length=255, nullable=true)
     */
    private $sexe;

    /**
     * @var string
     *
     * @ORM\Column(name="type_id", type="string", length=255, nullable=true)
     */
    private $typeId;

    /**
     * @var int
     *
     * @ORM\Column(name="num_id", type="string", length=255, nullable=true)
     */
    private $numId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="ddn", type="date", nullable=true)
     */
    private $ddn;

    /**
     * @var string
     *
     * @ORM\Column(name="cp_nais", type="string", length=255, nullable=true)
     */
    private $cpNais;

    /**
     * @var string
     *
     * @ORM\Column(name="ville_nais", type="string", length=255, nullable=true)
     */
    private $villeNais;

    /**
     * @ORM\ManyToOne(targetEntity="ZRR\CandidatureBundle\Entity\Pays")
     */
    private $paysNais;

    /**
     * @ORM\ManyToOne(targetEntity="ZRR\CandidatureBundle\Entity\Pays")
     */
    private $nationalite;

    /**
     * @ORM\ManyToOne(targetEntity="ZRR\CandidatureBundle\Entity\Pays")
     */
    private $nationalite2;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=255, nullable=true)
     */
    private $adresse;

    /**
     * @var string
     *
     * @ORM\Column(name="cp", type="string", length=255, nullable=true)
     */
    private $cp;

    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string", length=255, nullable=true)
     */
    private $ville;

    /**
     * @ORM\ManyToOne(targetEntity="ZRR\CandidatureBundle\Entity\Pays")
     */
    private $pays;

    /**
     * @var string
     *
     * @ORM\Column(name="situation_pro", type="string", length=255, nullable=true)
     */
    private $situationPro;

    /**
     * @var string
     *
     * @ORM\Column(name="employeur", type="string", length=255, nullable=true)
     */
    private $employeur;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse_employeur", type="string", length=255, nullable=true)
     */
    private $adresseEmployeur;

    /**
     * @var string
     *
     * @ORM\Column(name="cp_employeur", type="string", length=255, nullable=true)
     */
    private $cpEmployeur;

    /**
     * @var string
     *
     * @ORM\Column(name="ville_employeur", type="string", length=255, nullable=true)
     */
    private $villeEmployeur;

    /**
     * @ORM\ManyToOne(targetEntity="ZRR\CandidatureBundle\Entity\Pays")
     */
    private $paysEmployeur;


    public function __construct(){
        $this->dossiers=new ArrayCollection();
        //$this->email=$this->getUser()->getEmail();
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
     * Set nom
     *
     * @param string $nom
     *
     * @return Candidat
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
     * Set prenom
     *
     * @param string $prenom
     *
     * @return Candidat
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set nomMarital
     *
     * @param string $nomMarital
     *
     * @return Candidat
     */
    public function setNomMarital($nomMarital)
    {
        $this->nomMarital = $nomMarital;

        return $this;
    }

    /**
     * Get nomMarital
     *
     * @return string
     */
    public function getNomMarital()
    {
        return $this->nomMarital;
    }

    /**
     * Set sexe
     *
     * @param string $sexe
     *
     * @return Candidat
     */
    public function setSexe($sexe)
    {
        $this->sexe = $sexe;

        return $this;
    }

    /**
     * Get sexe
     *
     * @return string
     */
    public function getSexe()
    {
        return $this->sexe;
    }

    /**
     * Set typeId
     *
     * @param string $typeId
     *
     * @return Candidat
     */
    public function setTypeId($typeId)
    {
        $this->typeId = $typeId;

        return $this;
    }

    /**
     * Get typeId
     *
     * @return string
     */
    public function getTypeId()
    {
        return $this->typeId;
    }

    /**
     * Set numId
     *
     * @param integer $numId
     *
     * @return Candidat
     */
    public function setNumId($numId)
    {
        $this->numId = $numId;

        return $this;
    }

    /**
     * Get numId
     *
     * @return int
     */
    public function getNumId()
    {
        return $this->numId;
    }

    /**
     * Set ddn
     *
     * @param \DateTime $ddn
     *
     * @return Candidat
     */
    public function setDdn($ddn)
    {
        $this->ddn = $ddn;

        return $this;
    }

    /**
     * Get ddn
     *
     * @return \DateTime
     */
    public function getDdn()
    {
        return $this->ddn;
    }

    /**
     * Set villeNais
     *
     * @param string $villeNais
     *
     * @return Candidat
     */
    public function setVilleNais($villeNais)
    {
        $this->villeNais = $villeNais;

        return $this;
    }

    /**
     * Get villeNais
     *
     * @return string
     */
    public function getVilleNais()
    {
        return $this->villeNais;
    }

    /**
     * Set paysNais
     *
     * @param string $paysNais
     *
     * @return Candidat
     */
    public function setPaysNais($paysNais)
    {
        $this->paysNais = $paysNais;

        return $this;
    }

    /**
     * Get paysNais
     *
     * @return string
     */
    public function getPaysNais()
    {
        return $this->paysNais;
    }

    /**
     * Set nationalite
     *
     * @param string $nationalite
     *
     * @return Candidat
     */
    public function setNationalite($nationalite)
    {
        $this->nationalite = $nationalite;

        return $this;
    }

    /**
     * Get nationalite
     *
     * @return string
     */
    public function getNationalite()
    {
        return $this->nationalite;
    }

    /**
     * Set nationalite2
     *
     * @param string $nationalite2
     *
     * @return Candidat
     */
    public function setNationalite2($nationalite2)
    {
        $this->nationalite2 = $nationalite2;

        return $this;
    }

    /**
     * Get nationalite2
     *
     * @return string
     */
    public function getNationalite2()
    {
        return $this->nationalite2;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Candidat
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     *
     * @return Candidat
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
     * Set ville
     *
     * @param string $ville
     *
     * @return Candidat
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
     * Set pays
     *
     * @param string $pays
     *
     * @return Candidat
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
     * Set situationPro
     *
     * @param string $situationPro
     *
     * @return Candidat
     */
    public function setSituationPro($situationPro)
    {
        $this->situationPro = $situationPro;

        return $this;
    }

    /**
     * Get situationPro
     *
     * @return string
     */
    public function getSituationPro()
    {
        return $this->situationPro;
    }

    /**
     * Set employeur
     *
     * @param string $employeur
     *
     * @return Candidat
     */
    public function setEmployeur($employeur)
    {
        $this->employeur = $employeur;

        return $this;
    }

    /**
     * Get employeur
     *
     * @return string
     */
    public function getEmployeur()
    {
        return $this->employeur;
    }

    /**
     * Set adresseEmployeur
     *
     * @param string $adresseEmployeur
     *
     * @return Candidat
     */
    public function setAdresseEmployeur($adresseEmployeur)
    {
        $this->adresseEmployeur = $adresseEmployeur;

        return $this;
    }

    /**
     * Get adresseEmployeur
     *
     * @return string
     */
    public function getAdresseEmployeur()
    {
        return $this->adresseEmployeur;
    }

    /**
     * Set villeEmployeur
     *
     * @param string $villeEmployeur
     *
     * @return Candidat
     */
    public function setVilleEmployeur($villeEmployeur)
    {
        $this->villeEmployeur = $villeEmployeur;

        return $this;
    }

    /**
     * Get villeEmployeur
     *
     * @return string
     */
    public function getVilleEmployeur()
    {
        return $this->villeEmployeur;
    }

    /**
     * Set paysEmployeur
     *
     * @param string $paysEmployeur
     *
     * @return Candidat
     */
    public function setPaysEmployeur($paysEmployeur)
    {
        $this->paysEmployeur = $paysEmployeur;

        return $this;
    }

    /**
     * Get paysEmployeur
     *
     * @return string
     */
    public function getPaysEmployeur()
    {
        return $this->paysEmployeur;
    }

    /**
     * Set laboratoire
     *
     * @param \ZRR\CandidatureBundle\Entity\Laboratoire $laboratoire
     *
     * @return Candidat
     */
    public function setLaboratoire(\ZRR\CandidatureBundle\Entity\Laboratoire $laboratoire)
    {
        $this->laboratoire = $laboratoire;

        return $this;
    }

    /**
     * Get laboratoire
     *
     * @return \ZRR\CandidatureBundle\Entity\Laboratoire
     */
    public function getLaboratoire()
    {
        return $this->laboratoire;
    }

    /**
     * Add dossier
     *
     * @param \ZRR\CandidatureBundle\Entity\Dossier $dossier
     *
     * @return Candidat
     */
    public function addDossier(\ZRR\CandidatureBundle\Entity\Dossier $dossier)
    {
        $this->dossiers[] = $dossier;
        $dossier->setCandidat($this);

        return $this;
    }

    /**
     * Remove dossier
     *
     * @param \ZRR\CandidatureBundle\Entity\Dossier $dossier
     */
    public function removeDossier(\ZRR\CandidatureBundle\Entity\Dossier $dossier)
    {
        $this->dossiers->removeElement($dossier);
    }

    /**
     * Get dossiers
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDossiers()
    {
        return $this->dossiers;
    }

    /**
     * Set infoCompl
     *
     * @param \ZRR\CandidatureBundle\Entity\InfoCompl $infoCompl
     *
     * @return Dossier
     */
    public function setInfoCompl(\ZRR\CandidatureBundle\Entity\InfoCompl $infoCompl = null)
    {
        $this->infoCompl = $infoCompl;

        return $this;
    }

    /**
     * Get infoCompl
     *
     * @return \ZRR\CandidatureBundle\Entity\InfoCompl
     */
    public function getInfoCompl()
    {
        return $this->infoCompl;
    }


    /**
     * Set cpNais
     *
     * @param string $cpNais
     *
     * @return Candidat
     */
    public function setCpNais($cpNais)
    {
        $this->cpNais = $cpNais;

        return $this;
    }

    /**
     * Get cpNais
     *
     * @return string
     */
    public function getCpNais()
    {
        return $this->cpNais;
    }

    /**
     * Set cp
     *
     * @param string $cp
     *
     * @return Candidat
     */
    public function setCp($cp)
    {
        $this->cp = $cp;

        return $this;
    }

    /**
     * Get cp
     *
     * @return string
     */
    public function getCp()
    {
        return $this->cp;
    }

    /**
     * Set cpEmployeur
     *
     * @param string $cpEmployeur
     *
     * @return Candidat
     */
    public function setCpEmployeur($cpEmployeur)
    {
        $this->cpEmployeur = $cpEmployeur;

        return $this;
    }

    /**
     * Get cpEmployeur
     *
     * @return string
     */
    public function getCpEmployeur()
    {
        return $this->cpEmployeur;
    }

    /**
     * Set user
     *
     * @param \ZRR\UserBundle\Entity\User $user
     *
     * @return Candidat
     */
    public function setUser(\ZRR\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \ZRR\UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
}
