<?php

namespace ZRR\CandidatureBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DirigerZrr
 *
 * @ORM\Table(name="diriger_zrr")
 * @ORM\Entity(repositoryClass="ZRR\CandidatureBundle\Repository\DirigerZrrRepository")
 */
class DirigerZrr
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
     * @var \DateTime
     *
     * @ORM\Column(name="dateDebut", type="date", nullable=true)
     */
    private $dateDebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateFin", type="date", nullable=true)
     */
    private $dateFin;

    //proprietaire
    /**
     * @ORM\ManyToOne(targetEntity="ZRR\CandidatureBundle\Entity\Zrr", inversedBy="dirigerZrrs")
     * @ORM\JoinColumn(nullable=true)
     */
    private $zrr;

    /**
     * @ORM\ManyToOne(targetEntity="ZRR\CandidatureBundle\Entity\ResponsableSci", inversedBy="dirigerZrrs")
     * @ORM\JoinColumn(nullable=true)
     */
    private $responsableSci;


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
     * Set dateDebut
     *
     * @param \DateTime $dateDebut
     *
     * @return DirigerZrr
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
     * @return DirigerZrr
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
     * Set zrr
     *
     * @param \stdClass $zrr
     *
     * @return DirigerZrr
     */
    public function setZrr($zrr)
    {
        $this->zrr = $zrr;

        return $this;
    }

    /**
     * Get zrr
     *
     * @return \stdClass
     */
    public function getZrr()
    {
        return $this->zrr;
    }

    /**
     * Set responsableSci
     *
     * @param \stdClass $responsableSci
     *
     * @return DirigerZrr
     */
    public function setResponsableSci($responsableSci)
    {
        $this->responsableSci = $responsableSci;

        return $this;
    }

    /**
     * Get responsableSci
     *
     * @return \stdClass
     */
    public function getResponsableSci()
    {
        return $this->responsableSci;
    }
}

