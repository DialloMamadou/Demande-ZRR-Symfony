<?php

namespace ZRR\CandidatureBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use ZRR\CandidatureBundle\Entity\Activite;
use ZRR\CandidatureBundle\Entity\Dossier;
use ZRR\CandidatureBundle\Entity\InfoCompl;
use ZRR\CandidatureBundle\Entity\Laboratoire;
use ZRR\CandidatureBundle\Form\ActiviteType;
use ZRR\CandidatureBundle\Form\CandidatType;
use ZRR\CandidatureBundle\Form\DossierType;
use ZRR\CandidatureBundle\Form\InfoComplType;
use ZRR\CandidatureBundle\Form\LaboratoireType;

class TestController extends Controller
{
    public function indexAction(Request $request)
    {
        return $this->render('ZRRCandidatureBundle:Default:index.html.twig');
    }


    public function testAction(Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $labo = $em->getRepository('ZRRCandidatureBundle:Laboratoire')->find(3);


        $form = $this->get('form.factory')->create(LaboratoireType::class, $labo);


        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {

            return $this->redirectToRoute('zrr_info_compl_page');

        }


        return $this->render('ZRRCandidatureBundle:Default:test.html.twig', array(

            'form' => $form->createView(),

        ));
        //return $this->render('ZRRCandidatureBundle:Default:index.html.twig');
    }

}