<?php

namespace ZRR\CandidatureBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Dossier
 *
 * @ORM\Table(name="dossier")
 * @ORM\Entity(repositoryClass="ZRR\CandidatureBundle\Repository\DossierRepository")
 */
class Dossier
{
    //inverse
    /**
     * @ORM\OneToMany(targetEntity="ZRR\CandidatureBundle\Entity\Document", mappedBy="dossier", cascade={"persist", "remove"})
     * @Assert\Valid()
     */
    private $documents;

    //propriétaire
    /**
     * @ORM\ManyToOne(targetEntity="ZRR\CandidatureBundle\Entity\Candidat", inversedBy="dossiers", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $candidat;

    //propriétaire
    /*
     * @ORM\OneToOne(targetEntity="ZRR\CandidatureBundle\Entity\InfoCompl", cascade={"persist","remove"})
     */
    //private $infoCompl;

    //propriétaire
    /**
     * @ORM\OneToOne(targetEntity="ZRR\CandidatureBundle\Entity\Activite", inversedBy="dossier",cascade={"persist","remove"})
     */
    private $activite;

    //propriétaire
    /**
     * @ORM\ManyToOne(targetEntity="ZRR\CandidatureBundle\Entity\Zrr", inversedBy="dossiers")
     */
    private $zrr;

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
     * @ORM\Column(name="num_dossier", type="string", length=255, nullable=true)
     */
    private $numDossier;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_demande", type="date", nullable=true)
     */
    private $dateDemande;

    /**
     * @var int
     *
     * @ORM\Column(name="num_demande", type="integer", nullable=true)
     */
    private $numDemande;

    /**
     * @var string
     *
     * @ORM\Column(name="etat_dossier", type="string", length=255, nullable=true)
     */
    private $etatDossier;

    /**
     * @var string
     *
     * @ORM\Column(name="avis_resp", type="string", length=255, nullable=true)
     */
    private $avisResp;

    /**
     * @var string
     *
     * @ORM\Column(name="avis_chef", type="string", length=255, nullable=true)
     */
    private $avisChef;

    /**
     * @var string
     *
     * @ORM\Column(name="avis_ministere", type="string", length=255, nullable=true)
     */
    private $avisMinistere;

    /**
     * @var string
     *
     * @ORM\Column(name="commentaire", type="string", length=255, nullable=true)
     */
    private $commentaire;


    public function __construct()
    {
        $this->etatDossier="Dossier en attente";
        $this->documents=new ArrayCollection();
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
     * Set numDossier
     *
     * @param string $numDossier
     *
     * @return Dossier
     */
    public function setNumDossier($numDossier)
    {
        $this->numDossier = $numDossier;

        return $this;
    }

    /**
     * Get numDossier
     *
     * @return string
     */
    public function getNumDossier()
    {
        return $this->numDossier;
    }

    /**
     * Set dateDemande
     *
     * @param \DateTime $dateDemande
     *
     * @return Dossier
     */
    public function setDateDemande($dateDemande)
    {
        $this->dateDemande = $dateDemande;

        return $this;
    }

    /**
     * Get dateDemande
     *
     * @return \DateTime
     */
    public function getDateDemande()
    {
        return $this->dateDemande;
    }

    /**
     * Set numDemande
     *
     * @param integer $numDemande
     *
     * @return Dossier
     */
    public function setNumDemande($numDemande)
    {
        $this->numDemande = $numDemande;

        return $this;
    }

    /**
     * Get numDemande
     *
     * @return int
     */
    public function getNumDemande()
    {
        return $this->numDemande;
    }

    /**
     * Set etatDossier
     *
     * @param string $etatDossier
     *
     * @return Dossier
     */
    public function setEtatDossier($etatDossier)
    {
        $this->etatDossier = $etatDossier;

        return $this;
    }

    /**
     * Get etatDossier
     *
     * @return string
     */
    public function getEtatDossier()
    {
        return $this->etatDossier;
    }

    /**
     * Set avisResp
     *
     * @param string $avisResp
     *
     * @return Dossier
     */
    public function setAvisResp($avisResp)
    {
        $this->avisResp = $avisResp;

        return $this;
    }

    /**
     * Get avisResp
     *
     * @return string
     */
    public function getAvisResp()
    {
        return $this->avisResp;
    }

    /**
     * Set avisChef
     *
     * @param string $avisChef
     *
     * @return Dossier
     */
    public function setAvisChef($avisChef)
    {
        $this->avisChef = $avisChef;

        return $this;
    }

    /**
     * Get avisChef
     *
     * @return string
     */
    public function getAvisChef()
    {
        return $this->avisChef;
    }

    /**
     * Set avisMinistere
     *
     * @param string $avisMinistere
     *
     * @return Dossier
     */
    public function setAvisMinistere($avisMinistere)
    {
        $this->avisMinistere = $avisMinistere;

        return $this;
    }

    /**
     * Get avisMinistere
     *
     * @return string
     */
    public function getAvisMinistere()
    {
        return $this->avisMinistere;
    }

    /**
     * Set commentaire
     *
     * @param string $commentaire
     *
     * @return Dossier
     */
    public function setCommentaire($commentaire)
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    /**
     * Get commentaire
     *
     * @return string
     */
    public function getCommentaire()
    {
        return $this->commentaire;
    }

    /**
     * Set candidat
     *
     * @param \ZRR\CandidatureBundle\Entity\Candidat $candidat
     *
     * @return Dossier
     */
    public function setCandidat(\ZRR\CandidatureBundle\Entity\Candidat $candidat)
    {
        $this->candidat = $candidat;

        return $this;
    }

    /**
     * Get candidat
     *
     * @return \ZRR\CandidatureBundle\Entity\Candidat
     */
    public function getCandidat()
    {
        return $this->candidat;
    }

    /**
     * Set activite
     *
     * @param \ZRR\CandidatureBundle\Entity\Activite $activite
     *
     * @return Dossier
     */
    public function setActivite(\ZRR\CandidatureBundle\Entity\Activite $activite = null)
    {
        $this->activite = $activite;

        return $this;
    }

    /**
     * Get activite
     *
     * @return \ZRR\CandidatureBundle\Entity\Activite
     */
    public function getActivite()
    {
        return $this->activite;
    }

    /**
     * Set zrr
     *
     * @param \ZRR\CandidatureBundle\Entity\Zrr $zrr
     *
     * @return Dossier
     */
    public function setZrr(\ZRR\CandidatureBundle\Entity\Zrr $zrr = null)
    {
        $this->zrr = $zrr;

        return $this;
    }

    /**
     * Get zrr
     *
     * @return \ZRR\CandidatureBundle\Entity\Zrr
     */
    public function getZrr()
    {
        return $this->zrr;
    }

    /**
     * Add document
     *
     * @param \ZRR\CandidatureBundle\Entity\Document $document
     *
     * @return Dossier
     */
    public function addDocument(\ZRR\CandidatureBundle\Entity\Document $document)
    {
        $this->documents[] = $document;
        $document->setDossier($this);

        return $this;
    }

    /**
     * Remove document
     *
     * @param \ZRR\CandidatureBundle\Entity\Document $document
     */
    public function removeDocument(\ZRR\CandidatureBundle\Entity\Document $document)
    {
        $this->documents->removeElement($document);
    }

    /**
     * Get documents
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDocuments()
    {
        return $this->documents;
    }
}
