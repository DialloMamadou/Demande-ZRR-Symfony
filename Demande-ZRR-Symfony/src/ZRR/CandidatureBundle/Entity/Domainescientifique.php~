<?php

namespace ZRR\CandidatureBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Domainescientifique
 *
 * @ORM\Table(name="domainescientifique")
 * @ORM\Entity(repositoryClass="ZRR\CandidatureBundle\Repository\DomainescientifiqueRepository")
 */
class Domainescientifique
{
    //, mappedBy="Domainescientifique", cascade={"persist", "remove"}
    /**
     * @ORM\OneToMany(targetEntity="ZRR\CandidatureBundle\Entity\Disciplinescientifique", mappedBy="domainescientifique")
     */
    private $disciplinescientifiques;

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
     * @return Domainescientifique
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


    public function __toString()
    {
        return $this->nom;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->disciplinescientifiques = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add disciplinescientifique
     *
     * @param \ZRR\CandidatureBundle\Entity\Disciplinescientifique $disciplinescientifique
     *
     * @return Domainescientifique
     */
    public function addDisciplinescientifique(\ZRR\CandidatureBundle\Entity\Disciplinescientifique $disciplinescientifique)
    {
        $this->disciplinescientifiques[] = $disciplinescientifique;

        return $this;
    }

    /**
     * Remove disciplinescientifique
     *
     * @param \ZRR\CandidatureBundle\Entity\Disciplinescientifique $disciplinescientifique
     */
    public function removeDisciplinescientifique(\ZRR\CandidatureBundle\Entity\Disciplinescientifique $disciplinescientifique)
    {
        $this->disciplinescientifiques->removeElement($disciplinescientifique);
    }

    /**
     * Get disciplinescientifiques
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDisciplinescientifiques()
    {
        return $this->disciplinescientifiques;
    }
}
