<?php

namespace ZRR\CandidatureBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class DirigerLaboAddType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('dateDebut',DateType::class)
            //->add('dateFin')
            ->add('laboratoire', LaboType::class)
            ->add('responsableLabo',EntityType::class, array(
                //'by_reference'=>false,
                //'label_format'=>'responsableLabo.%nomResp%'.'responsableLabo.%prenomResp%',
                'choice_value' => 'id',

                'class'        => 'ZRRCandidatureBundle:ResponsableLabo',

                'choice_label' =>'nomResp',
                'required'=>true,

                'multiple'     => false,
                'expanded'=>false))
            ->add('save',      SubmitType::class, array('label' => 'Valider'));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ZRR\CandidatureBundle\Entity\DirigerLabo'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'zrr_candidaturebundle_dirigerlabo';
    }


}
