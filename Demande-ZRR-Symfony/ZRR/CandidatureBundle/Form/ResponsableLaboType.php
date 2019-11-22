<?php

namespace ZRR\CandidatureBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ResponsableLaboType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('telLabo', TextType::class, array("label"=>"Téléphone"))
            ->add('emailLabo', EmailType::class, array('label'=>'E-mail'))
            ->add('nomResp', TextType::class, array("label"=>"Nom du responsable"))
            ->add('prenomResp', TextType::class, array("label"=>"Prénom du responsable"))
        ;
            //->add('save',      SubmitType::class, array('label' => 'Valider'));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ZRR\CandidatureBundle\Entity\ResponsableLabo'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'zrr_candidaturebundle_responsablelabo';
    }


}
