<?php

namespace ZRR\CandidatureBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use ZRR\CandidatureBundle\Repository\ZrrRepository;

/**
 * Laboratoire
 *
 * @ORM\Table(name="laboratoire")
 * @ORM\Entity(repositoryClass="ZRR\CandidatureBundle\Repository\LaboratoireRepository")
 */
class Laboratoire
{

    //inverse
    /**
     * @ORM\OneToOne(targetEntity="ZRR\CandidatureBundle\Entity\Secretaire", mappedBy="laboratoire", cascade={"persist","remove"})
     */
    private $secretaire;


    public function getZrrInLabo($idLabo){
        $rep=$this->getDoctrine()->getManager()->getRepository('ZRRCandidatureBundle:Zrr');

        $qb = $rep->createQueryBuilder('z');
        $qb->where('z.laboratoire = :labo')->setParameter('labo', $idLabo);
        return $qb;
    }

    //inverse
    /**
     * @ORM\OneToMany(targetEntity="ZRR\CandidatureBundle\Entity\DirigerLabo", mappedBy="laboratoire")
     */
    private $dirigerLabos;

    //propriétaire
    /*
     * @ORM\OneToOne(targetEntity="ZRR\CandidatureBundle\Entity\ResponsableLabo", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     *
    private $responsableLabo;*/

    //inverse
    /**
     * @ORM\OneToMany(targetEntity="ZRR\CandidatureBundle\Entity\Candidat", mappedBy="laboratoire", cascade={"persist","remove"})
     */
    private $candidats;

    /**
     * @ORM\OneToMany(targetEntity="ZRR\CandidatureBundle\Entity\Zrr", mappedBy="laboratoire", cascade={"persist","remove"})
     */
    private $zrrs;

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
     * @ORM\Column(name="nom_labo", type="string", length=255)
     */
    private $nomLabo;

    /**
     * @var string
     *
     * @ORM\Column(name="code_labo", type="string", length=255)
     */
    private $codeLabo;

    public function __construct()
    {
        $this->candidats=new ArrayCollection();
        $this->zrrs=new ArrayCollection();
        $this->dirigerLabos = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Laboratoire
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
     * Set nomLabo
     *
     * @param string $nomLabo
     *
     * @return Laboratoire
     */
    public function setNomLabo($nomLabo)
    {
        $this->nomLabo = $nomLabo;

        return $this;
    }

    /**
     * Get nomLabo
     *
     * @return string
     */
    public function getNomLabo()
    {
        return $this->nomLabo;
    }

    /**
     * Set codeLabo
     *
     * @param string $codeLabo
     *
     * @return Laboratoire
     */
    public function setCodeLabo($codeLabo)
    {
        $this->codeLabo = $codeLabo;

        return $this;
    }

    /**
     * Get codeLabo
     *
     * @return string
     */
    public function getCodeLabo()
    {
        return $this->codeLabo;
    }


    /**
     * Add zrr
     *
     * @param \ZRR\CandidatureBundle\Entity\Zrr $zrr
     *
     * @return Laboratoire
     */
    public function addZrr(\ZRR\CandidatureBundle\Entity\Zrr $zrr)
    {
        $this->zrrs[] = $zrr;
        $zrr->setLaboratoire($this);

        return $this;
    }

    /**
     * Remove zrr
     *
     * @param \ZRR\CandidatureBundle\Entity\Zrr $zrr
     */
    public function removeZrr(\ZRR\CandidatureBundle\Entity\Zrr $zrr)
    {
        $this->zrrs->removeElement($zrr);
    }

    /**
     * Get zrrs
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getZrrs()
    {
        return $this->zrrs;
    }



    /**
     * Add candidat
     *
     * @param \ZRR\CandidatureBundle\Entity\Candidat $candidat
     *
     * @return Laboratoire
     */
    public function addCandidat(\ZRR\CandidatureBundle\Entity\Candidat $candidat)
    {
        $this->candidats[] = $candidat;
        $candidat->setLaboratoire($this);

        return $this;
    }

    /**
     * Remove candidat
     *
     * @param \ZRR\CandidatureBundle\Entity\Candidat $candidat
     */
    public function removeCandidat(\ZRR\CandidatureBundle\Entity\Candidat $candidat)
    {
        $this->candidats->removeElement($candidat);
    }

    /**
     * Get candidats
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCandidats()
    {
        return $this->candidats;
    }

    /**
     * Add dirigerLabo
     *
     * @param \ZRR\CandidatureBundle\Entity\DirigerLabo $dirigerLabo
     *
     * @return Laboratoire
     */
    public function addDirigerLabo(\ZRR\CandidatureBundle\Entity\DirigerLabo $dirigerLabo)
    {
        $this->dirigerLabos[] = $dirigerLabo;

        $dirigerLabo->setLaboratoire($this);

        return $this;
    }

    /**
     * Remove dirigerLabo
     *
     * @param \ZRR\CandidatureBundle\Entity\DirigerLabo $dirigerLabo
     */
    public function removeDirigerLabo(\ZRR\CandidatureBundle\Entity\DirigerLabo $dirigerLabo)
    {
        $this->dirigerLabos->removeElement($dirigerLabo);
    }

    /**
     * Get dirigerLabos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDirigerLabos()
    {
        return $this->dirigerLabos;
    }



    /**
     * Set secretaire
     *
     * @param \ZRR\CandidatureBundle\Entity\Secretaire $secretaire
     *
     * @return Laboratoire
     */
    public function setSecretaire(\ZRR\CandidatureBundle\Entity\Secretaire $secretaire = null)
    {
        $this->secretaire = $secretaire;

        return $this;
    }

    /**
     * Get secretaire
     *
     * @return \ZRR\CandidatureBundle\Entity\Secretaire
     */
    public function getSecretaire()
    {
        return $this->secretaire;
    }
}
