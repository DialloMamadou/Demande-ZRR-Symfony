<?php

namespace ZRR\CandidatureBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Secretaire
 *
 * @ORM\Table(name="secretaire")
 * @ORM\Entity(repositoryClass="ZRR\CandidatureBundle\Repository\SecretaireRepository")
 */
class Secretaire
{
    //inverse
    /**
     * @ORM\OneToOne(targetEntity="ZRR\UserBundle\Entity\User", mappedBy="secretaire", cascade={"persist","remove"})
     */
    private $user;

    //proprietaire
    /**
     * @ORM\OneToOne(targetEntity="ZRR\CandidatureBundle\Entity\Laboratoire", inversedBy="secretaire")
     *@ORM\JoinColumn(nullable=true)
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
     * @return Secretaire
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
     * @return Secretaire
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
     * Set user
     *
     * @param \ZRR\UserBundle\Entity\User $user
     *
     * @return Secretaire
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
     * Set laboratoire
     *
     * @param \ZRR\CandidatureBundle\Entity\Laboratoire $laboratoire
     *
     * @return Secretaire
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
