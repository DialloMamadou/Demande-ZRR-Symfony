<?php

namespace ZRR\CandidatureBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Zrr
 *
 * @ORM\Table(name="zrr")
 * @ORM\Entity(repositoryClass="ZRR\CandidatureBundle\Repository\ZrrRepository")
 */
class Zrr
{

    //inverse
    /**
     * @ORM\OneToMany(targetEntity="ZRR\CandidatureBundle\Entity\Dossier", mappedBy="zrr", cascade={"persist","remove"})
     */
    private $dossiers;

    /*
     * @ORM\OneToOne(targetEntity="ZRR\CandidatureBundle\Entity\ResponsableSci", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    //private $responsable;

    /**
     * @ORM\ManyToOne(targetEntity="ZRR\CandidatureBundle\Entity\Laboratoire", inversedBy="zrrs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $laboratoire;

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
     * @ORM\Column(name="code_zrr", type="string", length=255)
     */
    private $codeZrr;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse_zrr", type="string", length=255)
     */
    private $adresseZrr;

    /**
     * @var string
     *
     * @ORM\Column(name="ministere", type="string", length=255)
     */
    private $ministere;

    public function __construct()
    {
        $this->dossiers=new ArrayCollection();
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
     * Set codeZrr
     *
     * @param string $codeZrr
     *
     * @return Zrr
     */
    public function setCodeZrr($codeZrr)
    {
        $this->codeZrr = $codeZrr;

        return $this;
    }

    /**
     * Get codeZrr
     *
     * @return string
     */
    public function getCodeZrr()
    {
        return $this->codeZrr;
    }

    /**
     * Set adresseZrr
     *
     * @param string $adresseZrr
     *
     * @return Zrr
     */
    public function setAdresseZrr($adresseZrr)
    {
        $this->adresseZrr = $adresseZrr;

        return $this;
    }

    /**
     * Get adresseZrr
     *
     * @return string
     */
    public function getAdresseZrr()
    {
        return $this->adresseZrr;
    }

    /**
     * Set ministere
     *
     * @param string $ministere
     *
     * @return Zrr
     */
    public function setMinistere($ministere)
    {
        $this->ministere = $ministere;

        return $this;
    }

    /**
     * Get ministere
     *
     * @return string
     */
    public function getMinistere()
    {
        return $this->ministere;
    }

    /**
     * Set laboratoire
     *
     * @param \ZRR\CandidatureBundle\Entity\Laboratoire $laboratoire
     *
     * @return Zrr
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

    /*
     * Set responsable
     *
     * @param \ZRR\CandidatureBundle\Entity\ResponsableSci $responsable
     *
     * @return Zrr
     */
    /*public function setResponsable(\ZRR\CandidatureBundle\Entity\ResponsableSci $responsable = null)
    {
        $this->responsable = $responsable;

        return $this;
    }
*/
    /*
     * Get responsable
     *
     * @return \ZRR\CandidatureBundle\Entity\ResponsableSci
     */
   /* public function getResponsable()
    {
        return $this->responsable;
    }*/

    /**
     * Add dossier
     *
     * @param \ZRR\CandidatureBundle\Entity\Dossier $dossier
     *
     * @return Zrr
     */
    public function addDossier(\ZRR\CandidatureBundle\Entity\Dossier $dossier)
    {
        $this->dossiers[] = $dossier;
        $dossier->setZrr($this);

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

}
