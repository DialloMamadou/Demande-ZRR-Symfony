<?php
/**
 * Created by PhpStorm.
 * User: MCDIALLO
 * Date: 06/06/2018
 * Time: 08:26
 */

namespace ZRR\CandidatureBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use ZRR\CandidatureBundle\Entity\DirigerLabo;
use ZRR\CandidatureBundle\Entity\Dossier;
use ZRR\CandidatureBundle\Entity\Laboratoire;
use ZRR\CandidatureBundle\Entity\ResponsableLabo;
use ZRR\CandidatureBundle\Entity\Zrr;
use ZRR\CandidatureBundle\Form\DirigerLaboAddType;
use ZRR\CandidatureBundle\Form\DirigerLaboType;
use ZRR\CandidatureBundle\Form\DossierType;
use ZRR\CandidatureBundle\Form\LaboType;
use ZRR\CandidatureBundle\Form\ResponsableLaboType;
use ZRR\CandidatureBundle\Form\ZrrType;
use ZRR\UserBundle\Entity\User;
use ZRR\UserBundle\Form\RegistrationSecrFormType;

class AdministrateurController extends Controller
{

    public function indexAction(){

        $em =$this->getDoctrine()->getManager();
        $listDossier = $em->getRepository('ZRRCandidatureBundle:Dossier')->findAll();
        //return $this->render('ZRRCandidatureBundle:Default:index.html.twig');
        return $this->render('ZRRCandidatureBundle:Admin:index.html.twig', array('listDossier' => $listDossier));
    }

    //Action menu Admin
    public function menuAction()
    {
        $em = $this->getDoctrine()->getManager();

        $lesLabos = $em->getRepository('ZRRCandidatureBundle:Laboratoire')->findAll();

        return $this->render('ZRRCandidatureBundle:Admin:menu.html.twig', array('lesLabos'=>$lesLabos));


    }



    /* Les actions sur dossier */

    //Action view Dossier

    /**
     * @ParamConverter("dossier", options={"mapping": {"dossier_id": "id"}})
     */
    public function viewDossierAction(Dossier $dossier)
    {
        return $this->render('ZRRCandidatureBundle:Admin:view.html.twig', array('dossier'=>$dossier));
    }


    //Modification d'un Dossier
    /**
     * @ParamConverter("dossier", options={"mapping": {"dossier_id": "id"}})
     */
    public function editDossierAction(Dossier $dossier, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(DossierType::class, $dossier);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {

            // Inutile de persister ici, Doctrine connait déjà notre dossier
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Dossier a bien été modifiré.');

            // On redirige vers la page de visualisation du dossier nouvellement ajouté
            return $this->redirectToRoute('zrr_dossier_view', array('id' => $dossier->getId()));

        }

        // À ce stade, le formulaire n'est pas valide car :
        // - Soit la requête est de type GET, donc le visiteur vient d'arriver sur la page et veut voir le formulaire
        // - Soit la requête est de type POST, mais le formulaire contient des valeurs invalides, donc on l'affiche de nouveau
        return $this->render('ZRRCandidatureBundle:Admin:dossier.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    //Suppression d'un Dossier
    /**
     * @ParamConverter("dossier", options={"mapping": {"dossier_id": "id"}})
     */
    public function deletedossierAction(Request $request, Dossier $dossier)
    {
        // Ici, on récupère le repository
        $em = $this->getDoctrine()->getManager();

        // On crée un formulaire vide, qui ne contiendra que le champ CSRF
        // Cela permet de protéger la suppression du dossier contre cette faille
        $form = $this->get('form.factory')->create();

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            //On supprime le dossier
            $em->getRepository('ZRRCandidatureBundle:Dossier');
            $em->remove($dossier);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', "Le dossier a bien été supprimé.");

            return $this->redirectToRoute('zrr_admin_home_page');
        }

        return $this->render('ZRRCandidatureBundle:Admin:delete.html.twig', array(
            'dossier' => $dossier,
            'form' => $form->createView(),
        ));
    }

    // Exportion du dossier en format excel
    /**
     * @ParamConverter("dossier", options={"mapping": {"dossier_id": "id"}})
     */
    public function generateXlsxAction(Dossier $dossier)
    {
        return $this->redirectToRoute('zrr_admin_home_page');
    }
       /* // référence à la bibliothèque de fonctions

        require_once 'include/PHPExcel/PHPExcel.php';

        require_once 'include/PHPExcel/PHPExcel/IOFactory.php';



        if(isset($_POST['excel'])) {

            // création des objets de base et initialisation des informations d'entête

            $classeur = new PHPExcel;

            $classeur->getProperties()->setCreator("Annie Gagnon");

            $classeur->setActiveSheetIndex(0);

            $feuille=$classeur->getActiveSheet();



            // ajout des données dans la feuille de calcul

            $feuille->setTitle('Nom affiché dans l\'onglet');

            $feuille->setCellValueByColumnAndRow(0, 1, 'Les colonnes débutent à 0 et les lignes débutent à 1');

            $feuille->SetCellValue('A2', 'Il est aussi possible d\'utiliser la notation LettreChiffre (ex : A2)');



            // envoi du fichier au navigateur

            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

            header('Content-Disposition: attachment;filename="nomfichier.xlsx"');

            header('Cache-Control: max-age=0');

            $writer = PHPExcel_IOFactory::createWriter($classeur, 'Excel2007');

            $writer->save('php://output');

        }

        else {

            // on envoie de l'information à l'écran seulement si le bouton de génération n'a pas été cliqué

            require 'include/entete.inc.php';



            // affichage des données à l'écran




            // bouton qui permettra de générer le chiffrier Excel

            echo '<form method="post" action="' . $_SERVER['SCRIPT_NAME'] . '">';

            echo '<input type="submit" value="Exporter vers Excel" name="excel" />';

            echo '</form>';

        }

    }*/



    /*Les actions sur Laboratoire*/

    //Ajout d'un laboratoire
    public function addLaboAction(Request $request){

        return $this->render('ZRRCandidatureBundle:Admin:addLabo.html.twig');
    }


    /*Les actions sur Responsable labo*/
    //Ajout d'un Responsable laboratoire
    public function addRespLaboAction(Request $request){
        $em =$this->getDoctrine()->getManager();
        //$listResp = $em->getRepository('ZRRCandidatureBundle:ResponsableLabo')->findAll();
        $dirigerlabo = new DirigerLabo();
        $form   = $this->get('form.factory')->create(DirigerLaboAddType::class, $dirigerlabo);


        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {

            //$docs=$dossier->getDocuments();
            /*foreach ($docs as $d){
                $d->setCandidat($candidat);
            }*/
            /*foreach ($docs as $d) {
                $dossier->addDocument($d);
            }*/

            $em->persist($dirigerlabo);
            //$dossier=new

            $em->flush();


            $request->getSession()->getFlashBag()->add('notice', 'Responsable de Laboratoire enregistré.');


            return $this->redirectToRoute('zrr_admin_home_page');

        }


        return $this->render('ZRRCandidatureBundle:Admin:addRespLabo.html.twig', array(
                'form' => $form->createView())

        );
    }

    //Modification d'un Responsable labo
    public function editRespLaboAction(Request $request){
        $em =$this->getDoctrine()->getManager();
        //$listResp = $em->getRepository('ZRRCandidatureBundle:ResponsableLabo')->findAll();
        $dirigerlabo = new DirigerLabo();
        $form   = $this->get('form.factory')->create(DirigerLaboType::class, $dirigerlabo);


        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {

            //$docs=$dossier->getDocuments();
            /*foreach ($docs as $d){
                $d->setCandidat($candidat);
            }*/
            /*foreach ($docs as $d) {
                $dossier->addDocument($d);
            }*/

            $em->persist($dirigerlabo);
            //$dossier=new

            $em->flush();


            $request->getSession()->getFlashBag()->add('notice', 'Responsable de Laboratoire enregistré.');


            return $this->redirectToRoute('zrr_admin_home_page');

        }



        return $this->render('ZRRCandidatureBundle:Admin:editRespLabo.html.twig', array(
                'form' => $form->createView())

        );
    }



    /*Les actions sur ZRR*/

    //Ajout d'une ZRR
    /**
     * @ParamConverter("labo", options={"mapping": {"labo_id": "id"}})
     */
    public function addZrrAction(Laboratoire $labo, Request $request){
        $em =$this->getDoctrine()->getManager();
        //$listResp = $em->getRepository('ZRRCandidatureBundle:ResponsableLabo')->findAll();
        $zrr = new Zrr();
        $zrr->setLaboratoire($labo);
        $form   = $this->get('form.factory')->create(ZrrType::class, $zrr);


        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {


            $em->persist($zrr);

            $em->flush();


            $request->getSession()->getFlashBag()->add('notice', 'ZRR bien enregistrée.');


            return $this->redirectToRoute('zrr_admin_home_page');

        }
        return $this->render('ZRRCandidatureBundle:Admin:addZrr.html.twig', array('form' => $form->createView()));
    }

    //Action viewZRR
    /**
     * @ParamConverter("zrr", options={"mapping": {"zrr_id": "id"}})
     */
    public function viewZrrAction(ZRR $zrr){

        return $this->render('ZRRCandidatureBundle:Admin:viewzrr.html.twig', array('zrr' => $zrr));
    }

    //Modification d'une ZRR
    /**
     * @ParamConverter("zrr", options={"mapping": {"zrr_id": "id"}})
     */
    public function editZrrAction(ZRR $zrr, Request $request){
        $em =$this->getDoctrine()->getManager();

        $form   = $this->get('form.factory')->create(ZrrType::class, $zrr);


        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {


            $em->persist($zrr);

            $em->flush();


            $request->getSession()->getFlashBag()->add('notice', 'La modification de la ZRR à bin été enregistrée.');


            return $this->redirectToRoute('zrr_admin_home_page');

        }
        return $this->render('ZRRCandidatureBundle:Admin:addZrr.html.twig', array('form' => $form->createView()));
    }


    /*Les actions sur Secretaire*/
    //Ajout d'un secrétaire
    public function addsecrAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $user=new User();
        $user->addRole('ROLE_SECR');

        //echo $user;
        //$session=$request->getSession();
        //$session->set('user',$user);

        //$dossier = $em->getRepository('ZRRCandidatureBundle:Dossier')->findBy(array('candidat'=>$user));

        //$dossier = $session->get('dossier');
        $form   = $this->get('form.factory')->create(RegistrationSecrFormType::class, $user);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {

            //$docs=$dossier->getDocuments();
            /*foreach ($docs as $d){
                $d->setCandidat($candidat);
            }*/
            /*foreach ($docs as $d) {
                $dossier->addDocument($d);
            }*/


            //$dossier=new

            $em->persist($user);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Secrétaire enregistré(e).');


            return $this->redirectToRoute('zrr_candidature_homepage');

        }


        return $this->render('ZRRUserBundle:Registration:registersecr.html.twig', array(

            'form' => $form->createView(),

        ));
    }


    /**
     * @ParamConverter("zrr", options={"mapping": {"zrr_id": "id"}})
     */
    public function deleteZrrAction(Request $request, Zrr $zrr)

    {

        $em = $this->getDoctrine()->getManager();

        if (null === $zrr) {

            throw new NotFoundHttpException("La ZRR " . $zrr->getCodeZrr() . " n'existe pas.");

        }


        // On crée un formulaire vide, qui ne contiendra que le champ CSRF

        // Cela permet de protéger la suppression de zrr contre cette faille

        $form = $this->get('form.factory')->create();


        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {


            $em->remove($zrr);

            $em->flush();


            $request->getSession()->getFlashBag()->add('notice', "La ZRR a bien été supprimée.");


            return $this->redirectToRoute('zrr_admin_home_page');

        }


        return $this->render('ZRRCandidatureBundle:Admin:deletezrr.html.twig', array(

            'zrr' => $zrr,

            'form'   => $form->createView(),

        ));
    }


    public function languageAction(Request $request,$_locale){
        $translator=$this->get('translator');
        echo "_local $_locale \n";
        $translator->setFallbackLocales(array($_locale));
        $request->setDefaultLocale($_locale);
        $request->setLocale($_locale);
        $request->getSession()->set('_locale',$_locale);
        echo $request->getDefaultLocale();

        //echo $locale;
        echo $request->server->get('HTTP_REFERER');
        //HTTP_REFERER
        return $this->redirect($request->headers->get('referer'));

    }
}