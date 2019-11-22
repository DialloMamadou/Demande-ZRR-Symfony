<?php

namespace ZRR\CandidatureBundle\Repository;

/**
 * DossierRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class DossierRepository extends \Doctrine\ORM\EntityRepository
{
    //nombre de demandes pour le mois, l'année et la zrr en paramètre.
    public function nbDmdParMois($mois,$annee,$idzrr){
        $qb=$this->createQueryBuilder('d');
        $qb->select('d')
        ->where('d.zrr=:id')->setParameter('id',$idzrr)
            ->andWhere('d.dateDemande BETWEEN :debut AND :fin')->setParameter('debut',new \DateTime("$annee-$mois-0"))
            ->setParameter('fin',new \Datetime("$annee-$mois-31"))
        ;
        //$qb->expr()->count('d.id');

        return count($qb->getQuery()->getArrayResult());//->getOneOrNullResult();

    }

    //nombre de demandes pour le mois, l'année en cours, pour la zrr en paramètre. a mettre dans numdossier
    public function calculerNumDmd($codezrr){
        $date=new \Datetime();
        $an= date_format($date,'Y');
        $mois= date_format($date,'m');
        return $this->nbDmdParMois($mois,$an,$codezrr);

    }
}
