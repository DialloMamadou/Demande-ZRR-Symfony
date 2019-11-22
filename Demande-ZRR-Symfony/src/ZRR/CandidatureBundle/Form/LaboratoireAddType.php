<?php

namespace ZRR\CandidatureBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use ZRR\CandidatureBundle\Repository\ZrrRepository;

class LaboratoireAddType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nomLabo', TextType::class, array("label" => "Nom de l'établissement hébergeur de la ZRR"))
            ->add('codeLabo', TextType::class, array("label" => "Code de l'unité (si laboratoire de recherche)"))

            ->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event){
                $labo = $event->getData();
                $event->getForm()->add('zrrs', EntityType::class, array(

                    'class' => 'ZRRCandidatureBundle:Zrr',

                    'choice_label' => 'codeZrr' . ' ' . 'adresseZrr',
                    'required' => false,

                    'multiple' => false,
                    'expanded' => false,
                    'query_builder' => function (ZrrRepository $lab) use ($labo) {
                        if(null!==$labo) {
                            return $lab->getZrrInLabo($labo->getId());
                        }else{
                            return null;
                        }

                    },

                ));
            })


            ->add('telLabo', TextType::class, array("label"=>"Téléphone"))
            ->add('emailLabo', EmailType::class, array('label'=>'E-mail'));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ZRR\CandidatureBundle\Entity\Laboratoire'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'zrr_candidaturebundle_laboratoire';
    }


}
