<?php

namespace ZRR\CandidatureBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ResponsableSciNomType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nomResp',TextType::class)
            ->add('prenomResp', TextType::class)
            ->add('fonction', TextType::class, array("label"=>"Fonction du responsable"))
            ->add('laboratoire',EntityType::class, array(
                'by_reference'=>false,

                'class'        => 'ZRRCandidatureBundle:Laboratoire',

                'choice_label' => 'nomLabo',
                'required'=>true,

                'multiple'     => false,
                'expanded'=>false))
            ;
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ZRR\CandidatureBundle\Entity\ResponsableSci'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'zrr_activite_page';
    }


}
