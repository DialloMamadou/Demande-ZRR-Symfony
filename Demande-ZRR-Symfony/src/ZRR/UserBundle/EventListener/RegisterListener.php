<?php
/**
 * Created by PhpStorm.
 * User: Adélie
 * Date: 02/07/2018
 * Time: 15:06
 */

namespace ZRR\UserBundle\EventListener;


use Doctrine\Bundle\DoctrineBundle\DependencyInjection\DoctrineExtension;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use FOS\UserBundle\Event\FilterUserResponseEvent;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\FOSUserEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use ZRR\CandidatureBundle\Entity\Candidat;
use ZRR\CandidatureBundle\Entity\Dossier;
use ZRR\CandidatureBundle\Entity\Zrr;
use ZRR\CandidatureBundle\ZRRCandidatureBundle;
use ZRR\UserBundle\Entity\User;

class RegisterListener implements EventSubscriberInterface
{
    private $router;
    private $session;
    private $em;

    public function __construct(SessionInterface $session, UrlGeneratorInterface $router, EntityManagerInterface $em)
    {
        $this->router = $router;
        $this->session=$session;
        $this->em=$em;
    }
    /**
     * {@inheritDoc}
     */
    public static function getSubscribedEvents()
    {
        return array(
            FOSUserEvents::REGISTRATION_COMPLETED => 'relierDossier',
        );
    }
   /* public function onRegistrationConfirm(GetResponseUserEvent $event)
    {
        $url = $this->router->generate('ma_page_d_index');
        $event->setResponse(new RedirectResponse($url));
    }
*/

   /* public function postPersist(GetResponseUserEvent $event)

    {
        $event->getData();

        $entity = $args->getObject();
       // $args->getObjectManager();

        if (!$entity instanceof Candidat) {

            return;

        }
        $this->relierDossier($entity);

    }*/

    public function relierDossier(FilterUserResponseEvent  $event)
    {
        $user=$event->getUser();
        echo "CANDIDAT1";
        $cdd=$user->getCandidat();
        $cdd->setEmail($user->getEmail());
        var_dump($cdd);
        //$this->em->persist($user);
        //$em->flush();

        //echo "CANDIDAT2";
        //$cdd=$user->getCandidat();
        //var_dump($cdd);

        $dossier=$this->session->get('dossier');
        $dossier=$this->em->getRepository('ZRRCandidatureBundle:Dossier')->find($dossier->getId());
        echo "DOSSIER1";
        var_dump($dossier);


        $dossier->setCandidat($cdd);
        echo "DOSSIER2";
        var_dump($dossier);
        //$this->em->persist($dossier);
        $this->em->flush();
        echo "c bon";
        $url = $this->router->generate('fos_user_registration_check_email');
        $event->setResponse(new RedirectResponse($url));
        //$user->setCandidat($dossier->getCandidat());
    }
}