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
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use ZRR\CandidatureBundle\Repository\ZrrRepository;

class LaboCandidatType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {//charger labo du candidat du dossier->add('laboratoire',EntityType::class,

        $builder->add('laboratoire',EntityType::class, array(

            'class'        => 'ZRRCandidatureBundle:Laboratoire',

            'choice_label' => 'nomLabo',
            'required'=>true,

            'multiple'     => false,
            'label'=>'Nom de l\'établissement hébergeur de la ZRR',
            'expanded'=>false))
            ->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event){
                $laboratoire = $event->getData();
                $event->getForm()->add('zrrs', EntityType::class, array(
                    'label'=>'Zrr',

                    'class' => 'ZRRCandidatureBundle:Zrr',

                    'choice_label' => 'codeZrr' . ' ' . 'adresseZrr',
                    'required' => false,

                    'multiple' => false,
                    'expanded' => false,
                    'query_builder' => function (ZrrRepository $lab) use ($laboratoire) {
                        if(null!==$laboratoire) {
                            return $lab->getZrrInLabo($laboratoire->getId());
                        }else{
                            return null;
                        }

                    },

                ));
            });
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
