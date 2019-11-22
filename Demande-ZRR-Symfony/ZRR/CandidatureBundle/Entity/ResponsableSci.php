<?php

namespace ZRR\CandidatureBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * ResponsableSci
 *
 * @ORM\Table(name="responsable_sci")
 * @ORM\Entity(repositoryClass="ZRR\CandidatureBundle\Repository\ResponsableSciRepository")
 */
class ResponsableSci
{

    //inverse
    /**
     * @ORM\OneToMany(targetEntity="ZRR\CandidatureBundle\Entity\Activite", mappedBy="responsableSci", cascade={"persist"})
     */
    private $activites;

    //inverse
    /**
     * @ORM\OneToOne(targetEntity="ZRR\UserBundle\Entity\User", mappedBy="respSci", cascade={"persist","remove"})
     */
    private $user;

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
     * @return ResponsableSci
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
     * @return ResponsableSci
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
     * Set user
     *
     * @param \ZRR\UserBundle\Entity\User $user
     *
     * @return ResponsableSci
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
     * Constructor
     */
    public function __construct()
    {
        $this->activites=new ArrayCollection();
    }

    /**
     * Add activite
     *
     * @param \ZRR\CandidatureBundle\Entity\Activite $activite
     *
     * @return ResponsableSci
     */
    public function addActivite(\ZRR\CandidatureBundle\Entity\Activite $activite)
    {
        $this->activites[] = $activite;
        $activite->setResponsableSci($this);

        return $this;
    }

    /**
     * Remove activite
     *
     * @param \ZRR\CandidatureBundle\Entity\Activite $activite
     */
    public function removeActivite(\ZRR\CandidatureBundle\Entity\Activite $activite)
    {
        $this->activites->removeElement($activite);
    }

    /**
     * Get activites
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getActivites()
    {
        return $this->activites;
    }
}
