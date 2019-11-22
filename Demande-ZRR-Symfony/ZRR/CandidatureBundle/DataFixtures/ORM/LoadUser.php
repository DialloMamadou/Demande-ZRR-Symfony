<?php
/**
 * Created by PhpStorm.
 * User: Adélie
 * Date: 01/05/2018
 * Time: 21:43
 */

namespace ZRR\CandidatureBundle\DataFixtures\ORM;


use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use ZRR\CandidatureBundle\Entity\Candidat;
use ZRR\CandidatureBundle\Entity\Laboratoire;
use ZRR\CandidatureBundle\Entity\ResponsableLabo;


class LoadUser implements FixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        // Les noms d'utilisateurs à créer
       /* $resp = new ResponsableLabo();
        $resp->setNomResp('DIALLO');
        $resp->setPrenomResp('Mamadou');

        $labo=new Laboratoire();
        $labo->setResponsableLabo($resp);
        $labo->setNomLabo('GREMI');
        $labo->setCodeLabo('gremi1');
        $labo->setTelLabo('0243958761');
        $labo->setEmailLabo('gremi@gmail.com');

        $listNames = array('Alexandre', 'Marine', 'Anna');

        foreach ($listNames as $name) {

            // On crée l'utilisateur

            $user = new Candidat();


            // Le nom d'utilisateur et le mot de passe sont identiques pour l'instant

            $user->setUsername($name);

            $user->setPassword($name);
            $user->setNom($name);
            $user->setPrenom($name);

            $user->setLaboratoire($labo);


            // On ne se sert pas du sel pour l'instant

            $user->setSalt('');

            // On définit uniquement le role ROLE_USER qui est le role de base

            $user->setRoles(array('ROLE_USER'));


            // On le persiste

            $manager->persist($resp);

            $manager->persist($labo);

            $manager->persist($user);

        }


        // On déclenche l'enregistrement

        $manager->flush();*/
    }
}