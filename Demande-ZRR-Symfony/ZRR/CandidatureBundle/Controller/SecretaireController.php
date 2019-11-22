<?php
/**
 * Created by PhpStorm.
 * User: Adélie
 * Date: 25/06/2018
 * Time: 15:56
 */

namespace ZRR\CandidatureBundle\Controller;


use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use ZRR\CandidatureBundle\Email\ApplicationMailer;
use ZRR\CandidatureBundle\Entity\Dossier;

class SecretaireController extends Controller
{

    public function indexAction(){

        $em =$this->getDoctrine()->getManager();
        //il faudra prendre l'id de la secrétaire connectée
        //il faudra seulement prendre les dossiers du laboratoire de la secrétaire
        $listDossier = $em->getRepository('ZRRCandidatureBundle:Dossier')->findAll();



        //return $this->render('ZRRCandidatureBundle:Candidature:index.html.twig');
        return $this->render('ZRRCandidatureBundle:Secretaire:index.html.twig', array('listDossier' => $listDossier));
    }

    /**
     * @ParamConverter("dossier", options={"mapping": {"dossier_id": "id"}})
     */
    public function viewDossierAction(Dossier $dossier)
    {

        return $this->render('ZRRCandidatureBundle:Secretaire:view.html.twig', array('dossier'=>$dossier));
    }

    /**
     * @ParamConverter("dossier", options={"mapping": {"dossier_id": "id"}})
     */
    public function validerDossierAction(Dossier $dossier){
        $em = $this->getDoctrine()->getManager();
        //pour l'instant on récupère le nombre de demande de la ZRR 1.
        //il faudra récupérer la zrr de la secrétaire connectée
        $idzrr=1;
        $numdmd = $em->getRepository('ZRRCandidatureBundle:Dossier')->calculerNumDmd($idzrr);
        //echo $numdmd;
        $datedmd=new \DateTime('now');
        $dossier->setDateDemande($datedmd);

        $dossier->setNumDemande($numdmd+1);
        $codezrr=$em->getRepository('ZRRCandidatureBundle:Zrr')->find($idzrr)->getCodeZrr();
        $numdossier=$datedmd->format('Y-m').'-'.$codezrr.'-'.($numdmd+1);
        $dossier->setNumDossier($numdossier);
        //echo "numdossier: ".$numdossier;
        $em->flush($dossier);
        return $this->redirectToRoute('zrr_secr_home_page');
    }

    /**
     * @ParamConverter("dossier", options={"mapping": {"dossier_id": "id"}})
     */
    public function retournerDossierAction(Dossier $dossier){
        $cdd=$dossier->getCandidat();
        $resp=$dossier->getActivite()->getResponsableSci();
        // envoie un mail au responsable scientifique et au candidat
        try{

            $mailer = $this->container->get('mailer');;
            $app=new ApplicationMailer($mailer);
            $app->sendNotificationRespSci($resp);
            $app->sendNotificationCdd($cdd);
        }catch (Exception $e){
            echo $e->getMessage();
        }
        return $this->redirectToRoute('zrr_secr_home_page');

    }
}