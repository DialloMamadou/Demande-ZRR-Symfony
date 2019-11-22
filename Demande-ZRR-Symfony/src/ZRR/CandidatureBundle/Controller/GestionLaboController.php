<?php
/**
 * Created by PhpStorm.
 * User: Adélie
 * Date: 17/05/2018
 * Time: 11:44
 */

namespace ZRR\CandidatureBundle\Controller;


use ZRR\CandidatureBundle\Entity\Zrr;
use ZRR\CandidatureBundle\Form\ZrrType;

class GestionLaboController
{
    public function ajoutzrrAction(Request $request, $idLabo)
    {
        //récupérer le candidat connecté
        $zrr = new Zrr();

        $form   = $this->get('form.factory')->create(ZrrType::class, $zrr);


        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {

            $em = $this->getDoctrine()->getManager();

            $em->persist($zrr);

            $em->flush();


            $request->getSession()->getFlashBag()->add('notice', 'ZRR enregistrée.');


            return $this->redirectToRoute('zrr_candidature_homepage');

        }


        return $this->render('ZRRCandidatureBundle:Default:candidat.html.twig', array(

            'form' => $form->createView(),

        ));
        return $this->render('ZRRCandidatureBundle:Default:index.html.twig');
    }

}