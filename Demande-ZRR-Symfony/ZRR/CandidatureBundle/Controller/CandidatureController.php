<?php

namespace ZRR\CandidatureBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use ZRR\CandidatureBundle\Entity\Activite;
use ZRR\CandidatureBundle\Entity\Dossier;
use ZRR\CandidatureBundle\Entity\InfoCompl;
use ZRR\CandidatureBundle\Form\ActiviteType;
use ZRR\CandidatureBundle\Form\CandidatType;
use ZRR\CandidatureBundle\Form\DossierCandidatType;
use ZRR\CandidatureBundle\Form\DossierType;
use ZRR\CandidatureBundle\Form\InfoComplType;

class CandidatureController extends Controller
{

    public function candidatAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        //récupérer le candidat connecté
        $cand=$this->getUser()->getCandidat();
        $user=$cand->getId();
        echo $user;
        $session=$request->getSession();
        $session->set('candidat',$user);

        //$dossier = $em->getRepository('ZRRCandidatureBundle:Dossier')->findBy(array('candidat'=>$user));

        $dossier = new Dossier();
        $dossier->setCandidat($cand);
        $form   = $this->get('form.factory')->create(DossierCandidatType::class, $dossier);


        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {

            //$docs=$dossier->getDocuments();
            /*foreach ($docs as $d){
                $d->setCandidat($candidat);
            }*/
            /*foreach ($docs as $d) {
                $dossier->addDocument($d);
            }*/

            $em->persist($dossier);
            //$dossier=new

            $em->flush();


            $request->getSession()->getFlashBag()->add('notice', 'Default enregistrée.');


            return $this->redirectToRoute('zrr_candidature_homepage');

        }


        return $this->render('ZRRCandidatureBundle:Default:dossiercandidat.html.twig', array(

            'form' => $form->createView(),

        ));
        //return $this->render('ZRRCandidatureBundle:Default:index.html.twig');
    }


    public function zrrAction(Request $request/*, $idDossier*/)
    {
        /* prendre le dossier avec bon laboratoire et renvoyer formulaire pré-rempli
         */
        //$user = $this->get('security.token_storage')->getToken()->getUser();
        $em=$this->getDoctrine()->getManager();
        /*$dossier = $em->getRepository('ZRRCandidatureBundle:Dossier')->find($idDossier);

        $labo= $dossier->getCandidat()->getLaboratoire();*/

        $dossier=new Dossier();
        //$form = $this->get('form.factory')->create(LaboratoireType::class, $labo);

        $form = $this->get('form.factory')->create(DossierType::class, $dossier);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {

            //$dossier->setZrr($labo->getZrr);
            $dossier->setDateDemande(\DateTime());

            //ajouter numdossier

            //$docs=$zrr->getDocuments();
            /*foreach ($docs as $d){
                $d->setCandidat($candidat);
            }*/
           /* foreach ($docs as $d) {
                $zrr->addDocument($d);
            }*/

            $em->persist($dossier);

            $em->flush();


            $request->getSession()->getFlashBag()->add('notice', 'Default enregistrée.');


            return $this->redirectToRoute('zrr_candidature_homepage');

        }


        return $this->render('ZRRCandidatureBundle:Default:zrr.html.twig', array(

            'form' => $form->createView(),

        ));
        return $this->render('ZRRCandidatureBundle:Default:index.html.twig');
    }



    public function infoAction(){
        return $this->render('ZRRCandidatureBundle:Default:view.html.twig');
    }

    public function infoComplAction( Request $request)
    {
        // On crée un objet Activite

        $session=$request->getSession();
        $candidat= $session->get('candidat');
        $infoCompl = new InfoCompl();

        $form = $this->createForm(InfoComplType::class, $infoCompl);

        // Si la requête est en POST
        //On fait le lien Requête <-> Formulaire
        // et on vérifie que les valeurs entrées sont correctes
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            // À partir de maintenant, la variable $advert contient les valeurs entrées dans le formulaire par le visiteur

            // On enregistre notre objet $advert dans la base de données, par exemple
            $em = $this->getDoctrine()->getManager();
            $em->persist($infoCompl);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Informations bien enregistrées.');

            // On redirige vers la page de visualisation de l'annonce nouvellement créée
            return $this->render('ZRRCandidatureBundle:Default:view.html.twig', array('id' => $infoCompl->getId()));
        }
        // À ce stade, le formulaire n'est pas valide car :
        // - Soit la requête est de type GET, donc le visiteur vient d'arriver sur la page et veut voir le formulaire
        // - Soit la requête est de type POST, mais le formulaire contient des valeurs invalides, donc on l'affiche de nouveau
        return $this->render('ZRRCandidatureBundle:Default:infoCompl.html.twig', array(
            'form' => $form->createView(),
        ));
    }

}
