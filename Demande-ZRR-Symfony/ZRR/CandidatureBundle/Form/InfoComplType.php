<?php

namespace ZRR\CandidatureBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InfoComplType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('autreDmd', ChoiceType::class, array(
                'choices' => array(
                    'Non' =>'0',
                    'Oui' =>'1'),
                'label' => 'Indiquez si vous avez fait une autre demande d\'accès simultanément à celle-ci',))
            ->add('infoDmd', TextareaType::class, array('label' => 'Précisez '))
            ->add('autoAccesZrr',ChoiceType::class, array(
                'choices' => array(
                    'Non' =>'0',
                    'Oui' =>'1'),
                'label' => 'Avez-vous l\'autorisation d\'accès à une ZRR ?'))
            ->add('zrrConcernee',TextType::class, array('label' => 'Si oui, indiquer la ZRR concernée'))
            ->add('refHabilitation',TextType::class, array('label' => 'Si oui, indiquer la référence de l\'habitation'))
            ->add('protection',ChoiceType::class, array(
                'choices' => array(
                    'Non' =>'non',
                    'Oui' =>'oui'),
                'label' => 'Êtes-vous habilité au titre de la protection du secret de la défense nationale ?',))
            ->add('niveauHabilitation',TextType::class, array('label' => 'Si oui indiquez le niveau d\'habilitation'))
            ->add('autoriteHabilitation',TextType::class, array('label' => 'Si oui indiquez l\'autorité d\'habilitation'))
            //->add('save',      SubmitType::class, array('label' => 'Enregistrer'))
        ;
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ZRR\CandidatureBundle\Entity\InfoCompl'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'zrr_candidaturebundle_infocompl';
    }


}
