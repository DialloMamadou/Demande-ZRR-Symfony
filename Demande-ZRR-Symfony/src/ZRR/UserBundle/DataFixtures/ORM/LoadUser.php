<?php
/*/**
 * Created by PhpStorm.
 * User: Adélie
 * Date: 01/05/2018
 * Time: 21:43
 */

namespace ZRR\UserBundle\DataFixtures\ORM;


use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use ZRR\UserBundle\Entity\User;


/*class LoadUser implements FixtureInterface
{

    /*
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
/*    public function load(ObjectManager $manager)
    {
        // Les noms d'utilisateurs à créer

        $listNames = array('Alexandre', 'Marine', 'Anna');


        foreach ($listNames as $name) {

            // On crée l'utilisateur

            $user = new User;


            // Le nom d'utilisateur et le mot de passe sont identiques pour l'instant

            $user->setUsername($name);

            $user->setPassword($name);


            // On ne se sert pas du sel pour l'instant

            $user->setSalt('');

            // On définit uniquement le role ROLE_USER qui est le role de base

            $user->setRoles(array('ROLE_USER'));


            // On le persiste

            $manager->persist($user);

        }


        // On déclenche l'enregistrement

        $manager->flush();
    }
}*/