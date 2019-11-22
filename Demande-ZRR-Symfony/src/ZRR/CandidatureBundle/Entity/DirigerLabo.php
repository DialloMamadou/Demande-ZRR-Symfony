<?php

namespace ZRR\CandidatureBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DirigerLabo
 *
 * @ORM\Table(name="diriger_labo")
 * @ORM\Entity(repositoryClass="ZRR\CandidatureBundle\Repository\DirigerLaboRepository")
 */
class DirigerLabo
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
     * @ORM\ManyToOne(targetEntity="ZRR\CandidatureBundle\Entity\Laboratoire", inversedBy="dirigerLabos", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $laboratoire;

    /**
     * @ORM\ManyToOne(targetEntity="ZRR\CandidatureBundle\Entity\ResponsableLabo", inversedBy="dirigerLabos", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $responsableLabo;


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
     * @return DirigerLabo
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
     * @return DirigerLabo
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
     * Set responsableLabo
     *
     * @param \stdClass $responsableLabo
     *
     * @return DirigerLabo
     */
    public function setResponsableLabo($responsableLabo)
    {
        $this->responsableLabo = $responsableLabo;

        return $this;
    }

    /**
     * Get responsableLabo
     *
     * @return \stdClass
     */
    public function getResponsableLabo()
    {
        return $this->responsableLabo;
    }

    /**
     * Set laboratoire
     *
     * @param \ZRR\CandidatureBundle\Entity\Laboratoire $laboratoire
     *
     * @return DirigerLabo
     */
    public function setLaboratoire(\ZRR\CandidatureBundle\Entity\Laboratoire $laboratoire = null)
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
}
