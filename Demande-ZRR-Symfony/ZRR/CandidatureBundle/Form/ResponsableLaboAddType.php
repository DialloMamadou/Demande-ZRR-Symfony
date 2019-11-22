<?php

namespace ZRR\CandidatureBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ResponsableLaboAddType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        /*$builder->add('labo', ChoiceType::class, array(
            'label'=>'Zrr',

            //'class' => 'ZRRCandidatureBundle:Zrr',

            'choice_label' => 'codeZrr' . ' ' . 'adresseZrr',
            'required' => false,

            'multiple' => false,
            'expanded' => false,
            //'choices'=>$rep->getZrrInLabo($labo->getId()),
            'choices' =>$this->getZrr($labo)


        ))*/
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
