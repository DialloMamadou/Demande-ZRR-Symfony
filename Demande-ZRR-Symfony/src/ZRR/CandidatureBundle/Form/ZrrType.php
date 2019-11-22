<?php

namespace ZRR\CandidatureBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ZrrType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('codeZrr')
            ->add('adresseZrr')
            ->add('ministere', ChoiceType::class, array(
        'choices'  => array(
            'A - Ministère de la défense' => 'A - Ministère de la défense',
            'B - Ministère de l\'écologie' => 'B - Ministère de l\'écologie',
            'C - Ministère de l\'économie'=>'C - Ministère de l\'économie',
            'C - Ministère de l\'économie'=>'C - Ministère de l\'économie',
            'D - Ministère de la santé'=>'D - Ministère de la santé',
            'E - Ministère de l\'agriculture'=>'E - Ministère de l\'agriculture',
            'F - Ministère de l\'enseignement supérieur et de la recherche'=>'F - Ministère de l\'enseignement supérieur et de la recherche'
        ),
        'label'=> 'Ministère de rattachement'
    ))
            ->add('save',      SubmitType::class, array('label' => 'Valider'));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ZRR\CandidatureBundle\Entity\Zrr'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'zrr_candidaturebundle_zrr';
    }


}
