<?php

namespace ZRR\UserBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use FOS\UserBundle\Model\User as BaseUser;


/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="ZRR\UserBundle\Repository\UserRepository")
 */
class User extends BaseUser
{

    public function createPassword($nbCaractere)
    {
        $password = "";
        for($i = 0; $i <= $nbCaractere; $i++)
        {
            $random = rand(97,122);
            $password .= chr($random);
        }

        return $password;
    }

    //propriétaire
    /**
     * @ORM\OneToOne(targetEntity="ZRR\CandidatureBundle\Entity\Candidat", cascade={"persist","remove"}, inversedBy="user")
     */
    private $candidat;

    private $passwordtmp;

    /**
     * @return mixed
     */
    public function getPasswordtmp()
    {
        return $this->passwordtmp;
    }

    //propriétaire
    /**
     * @ORM\OneToOne(targetEntity="ZRR\CandidatureBundle\Entity\Secretaire", cascade={"persist","remove"}, inversedBy="user")
     */
    private $secretaire;

    //propriétaire
    /**
     * @ORM\OneToOne(targetEntity="ZRR\CandidatureBundle\Entity\ResponsableLabo", cascade={"persist","remove"}, inversedBy="user")
     */
    private $respLabo;

    //propriétaire
    /**
     * @ORM\OneToOne(targetEntity="ZRR\CandidatureBundle\Entity\ResponsableSci", cascade={"persist","remove"}, inversedBy="user")
     */
    private $respSci;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    protected $roles;

    protected $email;

    protected $enabled;

    protected $password;

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password=$password;
    }

    /**
     * @return mixed
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    /**
     * @param mixed $enabled
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;
    }

    public function __construct()
    {
        parent::__construct();

        $this->passwordtmp=$this->createPassword(8);
        $this->setPassword($this->passwordtmp);
        parent::setPlainPassword($this->passwordtmp);



        //$this->setEnabled(true);
    }
    /*public function addDocument(\ZRR\CandidatureBundle\Entity\Document $document)
    {
        $this->documents[] = $document;
        $document->setCandidat($this);

        return $this;
    }*/

    public function addRole($role)
    {
        return parent::addRole($role); // TODO: Change the autogenerated stub
    }


    /**
     * Set candidat
     *
     * @param \ZRR\CandidatureBundle\Entity\Candidat $candidat
     *
     * @return User
     */
    public function setCandidat(\ZRR\CandidatureBundle\Entity\Candidat $candidat = null)
    {
        $this->candidat = $candidat;
        $this->candidat->setEmail($this->email);

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
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * Set secretaire
     *
     * @param \ZRR\CandidatureBundle\Entity\Secretaire $secretaire
     *
     * @return User
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

    /**
     * Set respLabo
     *
     * @param \ZRR\CandidatureBundle\Entity\ResponsableLabo $respLabo
     *
     * @return User
     */
    public function setRespLabo(\ZRR\CandidatureBundle\Entity\ResponsableLabo $respLabo = null)
    {
        $this->respLabo = $respLabo;

        return $this;
    }

    /**
     * Get respLabo
     *
     * @return \ZRR\CandidatureBundle\Entity\ResponsableLabo
     */
    public function getRespLabo()
    {
        return $this->respLabo;
    }

    /**
     * Set respSci
     *
     * @param \ZRR\CandidatureBundle\Entity\ResponsableSci $respSci
     *
     * @return User
     */
    public function setRespSci(\ZRR\CandidatureBundle\Entity\ResponsableSci $respSci = null)
    {
        $this->respSci = $respSci;

        return $this;
    }

    /**
     * Get respSci
     *
     * @return \ZRR\CandidatureBundle\Entity\ResponsableSci
     */
    public function getRespSci()
    {
        return $this->respSci;
    }

}
