<?php

namespace ZRR\CandidatureBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class CandidatType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nom',TextType::class)
            ->add('prenom', TextType::class)
            ->add('nomMarital', TextType::class,
                array())
            ->add('sexe', ChoiceType::class, array(
                'choices'  => array(
                    'Homme' => 'homme',
                    'Femme' => 'femme',
                    'Autre' => 'autre'
                ),
                'expanded'=>false
            ))
            ->add('typeId', ChoiceType::class, array(
                'choices'  => array(
                    'Passeport' => 'passeport',
                    'Carte d\'identité' => 'carte d\'identité'
                ),
                    'label'=>'Type de pièce d\'identité')
            )
            ->add('numId', NumberType::class,array('label'=>'Numéro de pièce d\'identité'))
            ->add('ddn',BirthdayType::class,array(
                'years' => range(date('Y')-15, date('Y')-70),
                'label'=> 'Date de naissance'))
            ->add('cpNais', TextType::class,
                array('label'=> 'Code postal de naissance'))
            ->add('villeNais', TextType::class,
                array('label'=> 'Ville de naissance'))
            ->add('paysNais',   EntityType::class, array(
                'class'        => 'ZRRCandidatureBundle:Pays',

                'label' => 'Pays de naissance',
                'choice_label' => 'nom',
                'required'=>true,

                'multiple'     => false,
                'expanded'=>false))
            ->add('nationalite', EntityType::class, array(
                'label'=> 'Nationalité (pays)',
                'class'        => 'ZRRCandidatureBundle:Pays',
                'choice_label' => 'nom',
                'required'=>true,

                'multiple'     => false,
                'expanded'=>false))
            ->add('nationalite2', EntityType::class, array(
                'label'=> 'Autre nationalité (pays)',
                'class'        => 'ZRRCandidatureBundle:Pays',
                'choice_label' => 'nom',
                'required'=>true,

                'multiple'     => false,
                'expanded'=>false))
            ->add('email', RepeatedType::class, array(
                'type' => EmailType::class,
                //'invalid_message' => 'The password fields must match.',
                'required' => true,
                'first_options'  => array('label' => 'Adresse E-mail'),
                'second_options' => array('label' => 'Confirmation de l\'adresse E-mail'),
            ))
            //->add('email', EmailType::class,
                //array('label'=> 'Adresse E-mail'))
            ->add('adresse', TextType::class,
                array('label'=> 'Adresse principale actuelle'))
            ->add('cp', TextType::class,
                array('label'=> 'Code postal'))
            ->add('ville', TextType::class,
                array('label'=> 'Ville'))
            ->add('pays', EntityType::class, array(
                'class'        => 'ZRRCandidatureBundle:Pays',

                'choice_label' => 'nom',
                'required'=>true,

                'multiple'     => false,
                'expanded'=>false))
            ->add('situationPro', ChoiceType::class, array(
                'choices'  => array(
                    'Etudiant' => 'etudiant',
                    'Demandeur d\'emploi' => 'demandeur d\'emploi',
                    'Employé'=>'employé'
                ),
                'label'=> 'Situation professionnelle actuelle'
            ))
            ->add('employeur', TextType::class,
                array('label'=> 'Organisme employeur actuel'))
            ->add('adresseEmployeur', TextType::class,
                array('label'=> 'Adresse de l\'organisme employeur'))

            ->add('cpEmployeur', TextType::class,
                array('label'=> 'Code postal'))
            ->add('villeEmployeur', TextType::class,
                array('label'=> 'Ville'))
            ->add('paysEmployeur',  EntityType::class, array(
                'class'        => 'ZRRCandidatureBundle:Pays',

                'label' => 'Pays',
                'choice_label' => 'nom',
                'required'=>true,

                'multiple'     => false,
                'expanded'=>false))
            ->add('infoCompl',InfoComplType::class, array(
                'label'=>'Informations complémentaire',
                //'by_reference'=>false
            ))
            /*->add('documents',CollectionType::class, array(
                'entry_type' => DocumentType::class,
                'allow_add' =>true,
                'allow_delete' =>true,
                'by_reference'=>false
            ))
            ->add('save',      SubmitType::class, array('label' => 'Valider'))*/;
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ZRR\CandidatureBundle\Entity\Candidat'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'zrr_candidaturebundle_candidat';
    }


}
