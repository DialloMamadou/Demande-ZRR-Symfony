<?php

namespace ZRR\CandidatureBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Document
 *
 * @ORM\Table(name="document")
 * @ORM\Entity(repositoryClass="ZRR\CandidatureBundle\Repository\DocumentRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Document
{
    /**
     * @Assert\File(
     *     maxSize = "10M",
     *     mimeTypes = {"application/pdf"},
     *     mimeTypesMessage = "Please upload a valid PDF"
     * )
     */
    private $file;

    /**
     * @var string
     *
     * @ORM\Column(name="extension", type="string", length=255)
     */
    private $extension;

// On ajoute cet attribut pour y stocker le nom du fichier temporairement

    private $tempFilename;

    public function getFile()

    {

        return $this->file;

    }


    public function setFile(UploadedFile $file = null)

    {
        $this->file = $file;


        // On vérifie si on avait déjà un fichier pour cette entité

        if (null !== $this->extension) {

            // On sauvegarde l'extension du fichier pour le supprimer plus tard

            $this->tempFilename = $this->extension;


            // On réinitialise la valeur de l'attribut nom

            $this->nom = null;
            $this->extension=null;

        }

    }
    /**

     * @ORM\PrePersist()

     * @ORM\PreUpdate()

     */

    public function preUpload()

    {

        // Si jamais il n'y a pas de fichier (champ facultatif), on ne fait rien

        if (null === $this->file) {

            return;

        }


        // Le nom du fichier est son id, on doit juste stocker également son extension


        $this->extension = $this->file->guessExtension();


        // Et on génère l'attribut alt de la balise <img>, à la valeur du nom du fichier sur le PC de l'internaute

        $this->nom = $this->file->getClientOriginalName();

    }

    /**

     * @ORM\PostPersist()

     * @ORM\PostUpdate()

     */

    public function upload()

    {

        // Si jamais il n'y a pas de fichier (champ facultatif), on ne fait rien

        if (null === $this->file) {

            return;

        }


        // Si on avait un ancien fichier, on le supprime

        if (null !== $this->tempFilename) {

            $oldFile = $this->getUploadRootDir().'/'.$this->id.'.'.$this->tempFilename;

            if (file_exists($oldFile)) {

                unlink($oldFile);

            }

        }


        // On déplace le fichier envoyé dans le répertoire de notre choix

        $this->file->move(

            $this->getUploadRootDir(), // Le répertoire de destination

            $this->id.'.'.$this->extension   // Le nom du fichier à créer, ici « id.extension »

        );

    }
    /**

     * @ORM\PreRemove()

     */

    public function preRemoveUpload()

    {

        // On sauvegarde temporairement le nom du fichier, car il dépend de l'id

        $this->tempFilename = $this->getUploadRootDir().'/'.$this->id.'.'.$this->extension;

    }


    /**

     * @ORM\PostRemove()

     */

    public function removeUpload()

    {

        // En PostRemove, on n'a pas accès à l'id, on utilise notre nom sauvegardé

        if (file_exists($this->tempFilename)) {

            // On supprime le fichier

            unlink($this->tempFilename);

        }

    }


    public function getUploadDir()

    {

        // On retourne le chemin relatif vers le fchier pour un navigateur

        return 'uploads/doc';

    }


    protected function getUploadRootDir()

    {

        // On retourne le chemin relatif vers le fchier pour notre code PHP

        return __DIR__.'/../../../../web/'.$this->getUploadDir();

    }


    //proprietaire
    /**
     * @ORM\ManyToOne(targetEntity="ZRR\CandidatureBundle\Entity\Dossier", inversedBy="documents")
     * @ORM\JoinColumn(nullable=true)
     */
    private $dossier;

    /**
     * @ORM\OneToOne(targetEntity="ZRR\CandidatureBundle\Entity\Activite", inversedBy="document")
     * @ORM\JoinColumn(nullable=true)
     */
    private $activite;

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

    public function __construct()
    {
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
     * @return Document
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
     * Set extension
     *
     * @param string $extension
     *
     * @return Document
     */
    public function setExtension($extension)
    {
        $this->extension = $extension;

        return $this;
    }

    /**
     * Get extension
     *
     * @return string
     */
    public function getExtension()
    {
        return $this->extension;
    }

    /**
     * Set dossier
     *
     * @param \ZRR\CandidatureBundle\Entity\Dossier $dossier
     *
     * @return Document
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
     * Set activite
     *
     * @param \ZRR\CandidatureBundle\Entity\Activite $activite
     *
     * @return Document
     */
    public function setActivite(\ZRR\CandidatureBundle\Entity\Activite $activite = null)
    {
        $this->activite = $activite;

        return $this;
    }

    /**
     * Get activite
     *
     * @return \ZRR\CandidatureBundle\Entity\Activite
     */
    public function getActivite()
    {
        return $this->activite;
    }
}
