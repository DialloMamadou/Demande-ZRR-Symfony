<?php
/**
 * Created by PhpStorm.
 * User: Adélie
 * Date: 04/06/2018
 * Time: 16:57
 */

namespace ZRR\CandidatureBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use ZRR\CandidatureBundle\Entity\Activite;
use ZRR\CandidatureBundle\Entity\Candidat;
use ZRR\CandidatureBundle\Entity\Dossier;
use ZRR\CandidatureBundle\Form\ActiviteType;
use ZRR\CandidatureBundle\Form\DossierCandidatType;
use ZRR\UserBundle\Entity\User;
use ZRR\UserBundle\Form\RegistrationFormType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class ResponsableSciController extends Controller
{
    public function indexAction(Request $request){
        // On vérifie que l'utilisateur dispose bien du rôle ROLE_RESP
        $session=$request->getSession();

        if (!$this->get('security.authorization_checker')->isGranted('ROLE_RESP_SCI')) {
            throw new AccessDeniedException('Accès limité aux responsables.');
        }

        $em = $this->getDoctrine()->getManager();

        $user=$this->getUser();
        if(null===$user){
            return $this->redirectToRoute('fos_user_security_login');
        }else{
            $resp=$user->getRespSci();
            if(null!==$resp){
                $id=$resp->getId();

                $session->set('resp',$id);
                $listAct= $em->getRepository('ZRRCandidatureBundle:Activite')->findCddandAct($id);
                return $this->render('ZRRCandidatureBundle:Default:pageRespSci.html.twig', array(
                    'listact' => $listAct
                ));
            }else{
                throw new AccessDeniedException('Accès limité aux responsables.');
            }

        }


    }

    public function activiteAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        /// On crée un objet Activite
        $activite = new Activite();
        $dossier=new Dossier();
        $session=$request->getSession();
        $session->set('dossier',$dossier);
        //idresp
        $idr=$session->get('resp');
        $resp= $em->getRepository('ZRRCandidatureBundle:ResponsableSci')->find($idr);

        echo $resp->getId();


        echo $resp->getNomResp();

        //$codezrr;
        //calculerNumDmd

        $form = $this->createForm(ActiviteType::class, $activite);

        // Si la requête est en POST
        //On fait le lien Requête <-> Formulaire
        // et on vérifie que les valeurs entrées sont correctes
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            //on ajoute l'activité au responsable
            $resp->addActivite($activite);
            $dossier->setActivite($activite);
            $em->persist($dossier);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Activité enregistrée.');

            // On redirige vers la page pour créer candidat
            return $this->redirectToRoute('fos_user_registration_register');
        }
        // À ce stade, le formulaire n'est pas valide car :
        // - Soit la requête est de type GET, donc le visiteur vient d'arriver sur la page et veut voir le formulaire
        // - Soit la requête est de type POST, mais le formulaire contient des valeurs invalides, donc on l'affiche de nouveau
        return $this->render('ZRRCandidatureBundle:Default:activite.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function candidatAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user=$em->getRepository('ZRRUserBundle:User')->find(35);
        //echo $user;
        $session=$request->getSession();
        $session->set('user',$user);

        //$dossier = $em->getRepository('ZRRCandidatureBundle:Dossier')->findBy(array('candidat'=>$user));

        $dossier = $session->get('dossier');
        $form   = $this->get('form.factory')->create(RegistrationFormType::class, $user);
        $em->persist($user);
        $em->flush();
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {

            //$docs=$dossier->getDocuments();
            /*foreach ($docs as $d){
                $d->setCandidat($candidat);
            }*/
            /*foreach ($docs as $d) {
                $dossier->addDocument($d);
            }*/


            //$dossier=new



            $request->getSession()->getFlashBag()->add('notice', 'Default enregistrée.');


            return $this->redirectToRoute('zrr_candidature_homepage');

        }


        return $this->render('ZRRUserBundle:Registration:register.html.twig', array(

            'form' => $form->createView(),

        ));
        //return $this->render('ZRRCandidatureBundle:Default:index.html.twig');
    }

    /**
     * @ParamConverter("act", options={"mapping": {"act_id": "id"}})
     */
    public function viewActiviteAction(Activite $act){
        $em = $this->getDoctrine()->getManager();
        $cdd=$em->getRepository('ZRRCandidatureBundle:Candidat')->findCddofAct($act->getId());

        return $this->render('ZRRCandidatureBundle:Default:viewactivite.html.twig', array(

            'activite' => $act, 'candidat'=>$cdd

        ));
    }

    /**
     * @ParamConverter("act", options={"mapping": {"act_id": "id"}})
     */
    public function editActiviteAction(Request $request, Activite $act)
    {
        $em = $this->getDoctrine()->getManager();
        /// On crée un objet Activite
        $activite = $em->getRepository('ZRRCandidatureBundle:Activite')->find($act->getId());



        $form = $this->createForm(ActiviteType::class, $activite);

        // Si la requête est en POST
        //On fait le lien Requête <-> Formulaire
        // et on vérifie que les valeurs entrées sont correctes
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {

            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Activité enregistrée.');

            // On redirige vers la page pour créer candidat
            return $this->redirectToRoute('zrr_liste_activite',array('act_id'=>$act->getId()));
        }
        // À ce stade, le formulaire n'est pas valide car :
        // - Soit la requête est de type GET, donc le visiteur vient d'arriver sur la page et veut voir le formulaire
        // - Soit la requête est de type POST, mais le formulaire contient des valeurs invalides, donc on l'affiche de nouveau
        return $this->render('ZRRCandidatureBundle:Default:activite.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @ParamConverter("act", options={"mapping": {"act_id": "id"}})
     */
    public function deleteActiviteAction(Request $request, Activite $act)

    {

        $em = $this->getDoctrine()->getManager();

        if (null === $act) {

            throw new NotFoundHttpException("L'activité " . $act->getPoste() . " n'existe pas.");

        }


        // On crée un formulaire vide, qui ne contiendra que le champ CSRF

        // Cela permet de protéger la suppression de zrr contre cette faille

        $form = $this->get('form.factory')->create();


        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {


            $em->remove($act);

            $em->flush();


            $request->getSession()->getFlashBag()->add('info', "L'activité a bien été supprimée.");


            return $this->redirectToRoute('zrr_liste_activite');

        }


        return $this->render('ZRRCandidatureBundle:Default:deleteactivite.html.twig', array(

            'activite' => $act,

            'form'   => $form->createView(),

        ));
    }


}