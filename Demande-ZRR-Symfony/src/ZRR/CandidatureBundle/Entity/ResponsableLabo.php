<?php

namespace ZRR\CandidatureBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ResponsableLabo
 *
 * @ORM\Table(name="responsable_labo")
 * @ORM\Entity(repositoryClass="ZRR\CandidatureBundle\Repository\ResponsableLaboRepository")
 */
class ResponsableLabo
{

    //inverse
    /**
     * @ORM\OneToOne(targetEntity="ZRR\UserBundle\Entity\User", mappedBy="respLabo", cascade={"persist","remove"})
     */
    private $user;

    /**
     * @var string
     *
     * @ORM\Column(name="tel_labo", type="string", length=255)
     */
    private $telLabo;

    /**
     * @var string
     *
     * @ORM\Column(name="email_labo", type="string", length=255)
     */
    private $emailLabo;

    //inverse
    /**
     * @ORM\OneToMany(targetEntity="ZRR\CandidatureBundle\Entity\DirigerLabo", mappedBy="responsableLabo")
     */
    private $dirigerLabos;

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
     * @ORM\Column(name="nom_resp", type="string", length=255)
     */
    private $nomResp;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom_resp", type="string", length=255)
     */
    private $prenomResp;

    /**
     * @var string
     *
     * @ORM\Column(name="fonction", type="string", length=255)
     */
    private $fonction;



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
     * Set nomResp
     *
     * @param string $nomResp
     *
     * @return ResponsableLabo
     */
    public function setNomResp($nomResp)
    {
        $this->nomResp = $nomResp;

        return $this;
    }

    /**
     * Get nomResp
     *
     * @return string
     */
    public function getNomResp()
    {
        return $this->nomResp;
    }

    /**
     * Set prenomResp
     *
     * @param string $prenomResp
     *
     * @return ResponsableLabo
     */
    public function setPrenomResp($prenomResp)
    {
        $this->prenomResp = $prenomResp;

        return $this;
    }

    /**
     * Get prenomResp
     *
     * @return string
     */
    public function getPrenomResp()
    {
        return $this->prenomResp;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->dirigerLabos = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add dirigerLabo
     *
     * @param \ZRR\CandidatureBundle\Entity\DirigerLabo $dirigerLabo
     *
     * @return ResponsableLabo
     */
    public function addDirigerLabo(\ZRR\CandidatureBundle\Entity\DirigerLabo $dirigerLabo)
    {
        $this->dirigerLabos[] = $dirigerLabo;
        $dirigerLabo->setResponsableLabo($this);

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
     * Set telLabo
     *
     * @param string $telLabo
     *
     * @return Laboratoire
     */
    public function setTelLabo($telLabo)
    {
        $this->telLabo = $telLabo;

        return $this;
    }

    /**
     * Get telLabo
     *
     * @return string
     */
    public function getTelLabo()
    {
        return $this->telLabo;
    }

    /**
     * Set emailLabo
     *
     * @param string $emailLabo
     *
     * @return Laboratoire
     */
    public function setEmailLabo($emailLabo)
    {
        $this->emailLabo = $emailLabo;

        return $this;
    }

    /**
     * Get emailLabo
     *
     * @return string
     */
    public function getEmailLabo()
    {
        return $this->emailLabo;
    }

    /**
     * Set user
     *
     * @param \ZRR\UserBundle\Entity\User $user
     *
     * @return ResponsableLabo
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


    /**
     * Set fonction
     *
     * @param string $fonction
     *
     * @return ResponsableLabo
     */
    public function setFonction($fonction)
    {
        $this->fonction = $fonction;

        return $this;
    }

    /**
     * Get fonction
     *
     * @return string
     */
    public function getFonction()
    {
        return $this->fonction;
    }
}
