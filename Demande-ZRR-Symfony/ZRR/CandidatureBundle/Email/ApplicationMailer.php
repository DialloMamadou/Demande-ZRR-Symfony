<?php
/**
 * Created by PhpStorm.
 * User: Adélie
 * Date: 27/04/2018
 * Time: 12:24
 */

namespace ZRR\CandidatureBundle\Email;


use ZRR\CandidatureBundle\Entity\Candidat;
use ZRR\CandidatureBundle\Entity\ResponsableLabo;
use ZRR\CandidatureBundle\Entity\ResponsableSci;
use ZRR\CandidatureBundle\Entity\Secretaire;

class ApplicationMailer
{

    /**
     * @var \Swift_Mailer
     */
    private $mailer;

    private $emetteur;


    public function __construct(\Swift_Mailer $mailer)
    {
        $this->mailer = $mailer;
        $this->emetteur='labozrr@gmail.com';
    }


    //envoie un mail à la secrétaire après validation du candidat
    public function sendNotificationSecr(Secretaire $secr)
    {
        $mail=$secr->getUser()->getEmail();
        $message = new \Swift_Message('Dossier ZRR','Vous avez reçu un nouveau dossier à vérifier.');
        $message->addTo($mail)->addFrom($this->emetteur);
        $this->mailer->send($message);
    }

    //envoie un mail au directeur de labo après validation du candidat
    public function sendNotificationDir(ResponsableLabo $dir)
    {
        $mail=$dir->getEmailLabo();
        $message = new \Swift_Message('Dossier ZRR','Vous avez reçu un nouveau dossier à compléter.');
        $message->addTo($mail)->addFrom($this->emetteur);
        $this->mailer->send($message);
    }

    //envoie un mail au candidat car son dossier à été retourné par le secrétariat
    public function sendNotificationCdd(Candidat $cdd)
    {
        $mail=$cdd->getEmail();
        $message = new \Swift_Message('Dossier ZRR','Votre dossier a été retourné, vérifiez vos informations et vos documents.');
        $message->addTo($mail)->addFrom($this->emetteur);
        $this->mailer->send($message);
    }

    //envoie un mail au responsable scientifique car le dossier à été retourné par le secrétariat
    public function sendNotificationRespSci(ResponsableSci $resp)
    {
        $mail=$resp->getUser()->getEmail();
        $message = new \Swift_Message('Dossier ZRR','Le dossier a été retourné, vérifiez les informations et les documents.');
        $message->addTo($mail)->addFrom($this->emetteur);
        $this->mailer->send($message);
    }



}