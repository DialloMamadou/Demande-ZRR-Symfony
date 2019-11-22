<?php

namespace ZRR\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CoreController extends Controller
{
    public function indexAction()
    {
        return $this->render('ZRRCoreBundle:Core:index.html.twig');
    }
}
