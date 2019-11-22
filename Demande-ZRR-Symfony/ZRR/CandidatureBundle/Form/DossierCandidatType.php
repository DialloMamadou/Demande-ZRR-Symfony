<?php

namespace ZRR\CandidatureBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DossierCandidatType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('candidat', CandidatType::class, array(
                //'by_reference'=>false
            ))
            ->add('documents',CollectionType::class, array(
                'entry_type' => DocumentType::class,
                'allow_add' =>true,
                'allow_delete' =>true,
                'by_reference'=>false
            ))
            ->add('save',      SubmitType::class, array('label' => 'Valider'));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ZRR\CandidatureBundle\Entity\Dossier'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'zrr_candidaturebundle_dossier';
    }


}
