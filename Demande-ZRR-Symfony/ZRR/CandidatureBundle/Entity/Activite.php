<?php

namespace ZRR\CandidatureBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Activite
 *
 * @ORM\Table(name="activite")
 * @ORM\Entity(repositoryClass="ZRR\CandidatureBundle\Repository\ActiviteRepository")
 */
class Activite
{
    //propriétaire
    ////, inversedBy="activites")
    /**
     * @ORM\ManyToOne(targetEntity="ZRR\CandidatureBundle\Entity\ResponsableSci")
     */
    private $responsableSci;

    //inverse
    /**
     * @ORM\OneToOne(targetEntity="ZRR\CandidatureBundle\Entity\Document", mappedBy="activite", cascade={"persist", "remove"})
     * @Assert\Valid()
     *x/
    private $document;

    //inverse
    /**
     * @ORM\OneToOne(targetEntity="ZRR\CandidatureBundle\Entity\Dossier", mappedBy="activite", cascade={"persist"})
     */
    private $dossier;

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
     * @ORM\Column(name="statut", type="string", length=255)
     */
    private $statut;

    /**
     * @var string
     *
     * @ORM\Column(name="financement", type="string", length=255)
     */
    private $financement;

    /**
     * @var float
     *
     * @ORM\Column(name="montant_financement", type="float")
     */
    private $montantFinancement;

    /**
     * @var string
     *
     * @ORM\Column(name="type_acces", type="string", length=255)
     */
    private $typeAcces;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_debut", type="date")
     */
    private $dateDebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_fin", type="date")
     */
    private $dateFin;

    /*
     * @ORM\ManyToOne(targetEntity="ZRR\CandidatureBundle\Entity\Domainescientifique")
    */
    //private $domainescientifique;
    /**
     * @ORM\ManyToOne(targetEntity="ZRR\CandidatureBundle\Entity\Disciplinescientifique")
     * @Assert\NotBlank()
     */
    private $disciplinescientifique;

    /**
     * @var string
     *
     * @ORM\Column(name="poste", type="string", length=255)
     */
    private $poste;

    /**
     * @var string
     *
     * @ORM\Column(name="resume", type="text")
     */
    private $resume;


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
     * Set statut
     *
     * @param string $statut
     *
     * @return Activite
     */
    public function setStatut($statut)
    {
        $this->statut = $statut;

        return $this;
    }

    /**
     * Get statut
     *
     * @return string
     */
    public function getStatut()
    {
        return $this->statut;
    }

    /**
     * Set financement
     *
     * @param string $financement
     *
     * @return Activite
     */
    public function setFinancement($financement)
    {
        $this->financement = $financement;

        return $this;
    }

    /**
     * Get financement
     *
     * @return string
     */
    public function getFinancement()
    {
        return $this->financement;
    }

    /**
     * Set montantFinancement
     *
     * @param float $montantFinancement
     *
     * @return Activite
     */
    public function setMontantFinancement($montantFinancement)
    {
        $this->montantFinancement = $montantFinancement;

        return $this;
    }

    /**
     * Get montantFinancement
     *
     * @return float
     */
    public function getMontantFinancement()
    {
        return $this->montantFinancement;
    }

    /**
     * Set typeAcces
     *
     * @param string $typeAcces
     *
     * @return Activite
     */
    public function setTypeAcces($typeAcces)
    {
        $this->typeAcces = $typeAcces;

        return $this;
    }

    /**
     * Get typeAcces
     *
     * @return string
     */
    public function getTypeAcces()
    {
        return $this->typeAcces;
    }

    /**
     * Set dateDebut
     *
     * @param \DateTime $dateDebut
     *
     * @return Activite
     */
    public function setDateDebut($dateDebut)
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    /**
     * Get dateDebut
     *
     * @return \DateTime
     */
    public function getDateDebut()
    {
        return $this->dateDebut;
    }

    /**
     * Set dateFin
     *
     * @param \DateTime $dateFin
     *
     * @return Activite
     */
    public function setDateFin($dateFin)
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    /**
     * Get dateFin
     *
     * @return \DateTime
     */
    public function getDateFin()
    {
        return $this->dateFin;
    }


    /**
     * Set poste
     *
     * @param string $poste
     *
     * @return Activite
     */
    public function setPoste($poste)
    {
        $this->poste = $poste;

        return $this;
    }

    /**
     * Get poste
     *
     * @return string
     */
    public function getPoste()
    {
        return $this->poste;
    }

    /**
     * Set resume
     *
     * @param string $resume
     *
     * @return Activite
     */
    public function setResume($resume)
    {
        $this->resume = $resume;

        return $this;
    }

    /**
     * Get resume
     *
     * @return string
     */
    public function getResume()
    {
        return $this->resume;
    }

    /**
     * Set dossier
     *
     * @param \ZRR\CandidatureBundle\Entity\Dossier $dossier
     *
     * @return Activite
     */
    public function setDossier(\ZRR\CandidatureBundle\Entity\Dossier $dossier = null)
    {
        $this->dossier = $dossier;

        return $this;
    }

    /**
     * Get dossier
     *
     * @return \ZRR\CandidatureBundle\Entity\Dossier
     */
    public function getDossier()
    {
        return $this->dossier;
    }

    /**
     * Set document
     *
     * @param \ZRR\CandidatureBundle\Entity\Document $document
     *
     * @return Activite
     */
    public function setDocument(\ZRR\CandidatureBundle\Entity\Document $document = null)
    {
        $this->document = $document;

        return $this;
    }

    /**
     * Get document
     *
     * @return \ZRR\CandidatureBundle\Entity\Document
     */
    public function getDocument()
    {
        return $this->document;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->responsableScis = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Set responsableSci
     *
     * @param \ZRR\CandidatureBundle\Entity\ResponsableSci $responsableSci
     *
     * @return Activite
     */
    public function setResponsableSci(\ZRR\CandidatureBundle\Entity\ResponsableSci $responsableSci = null)
    {
        $this->responsableSci = $responsableSci;

        return $this;
    }

    /**
     * Get responsableSci
     *
     * @return \ZRR\CandidatureBundle\Entity\ResponsableSci
     */
    public function getResponsableSci()
    {
        return $this->responsableSci;
    }


    /*
     * Set domainescientifique
     *
     * @param \ZRR\CandidatureBundle\Entity\Domainescientifique $domainescientifique
     *
     * @return Activite
     *
    public function setDomainescientifique(\ZRR\CandidatureBundle\Entity\Domainescientifique $domainescientifique = null)
    {
        $this->domainescientifique = $domainescientifique;

        return $this;
    }

    *
     * Get domainescientifique
     *
     * @return \ZRR\CandidatureBundle\Entity\Domainescientifique

    public function getDomainescientifique()
    {
        return $this->domainescientifique;
    }
*/
    /**
     * Set disciplinescientifiquex`
     *
     * @param \ZRR\CandidatureBundle\Entity\Disciplinescientifique $disciplinescientifique
     *
     * @return Activite
     */
    public function setDisciplinescientifique(\ZRR\CandidatureBundle\Entity\Disciplinescientifique $disciplinescientifique = null)
    {
        $this->disciplinescientifique = $disciplinescientifique;

        return $this;
    }

    /**
     * Get disciplinescientifique
     *
     * @return \ZRR\CandidatureBundle\Entity\Disciplinescientifique
     */
    public function getDisciplinescientifique()
    {
        return $this->disciplinescientifique;
    }

    /**
     * Set domainescientifique
     *
     * @param \ZRR\CandidatureBundle\Entity\Domainescientifique $domainescientifique
     *
     * @return Activite
     */
    public function setDomainescientifique(\ZRR\CandidatureBundle\Entity\Domainescientifique $domainescientifique = null)
    {
        $this->domainescientifique = $domainescientifique;

        return $this;
    }

    /**
     * Get domainescientifique
     *
     * @return \ZRR\CandidatureBundle\Entity\Domainescientifique
     */
    public function getDomainescientifique()
    {
        return $this->domainescientifique;
    }
}
