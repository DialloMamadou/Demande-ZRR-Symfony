<?php

namespace ZRR\CandidatureBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use ZRR\CandidatureBundle\Entity\Disciplinescientifique;
use ZRR\CandidatureBundle\Entity\Domainescientifique;

class ActiviteType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('statut', ChoiceType::class, array(
                'choices' => array(
                    'CDI' => 'CDI',
                    'CDD' => 'CDD',
                    'Stage' => 'stage',
                    'Doctorat' => 'doctorat',
                    'Post-doctorat' => 'post-doctorant',
                    'Prestation externe de service' => 'prestation externe de service',
                    'Collaboration professionnelle' => 'collaboration professionnelle',
                    'Autre' => 'autre'
                ),
                'label' => 'Status au sein de la ZRR'))
            ->add('financement', TextType::class, array('label' => 'Origine du financement de la mission'))
            ->add('montantFinancement', MoneyType::class, array('label' => 'Montant du financemant en euros '))
            ->add('typeAcces', ChoiceType::class, array(
                'choices' => array(
                    'Physique' => 'physique',
                    'Virtuel' => 'virtuel',
                    'Physique et virtuel' => 'physique et virtuel',

                ), 'label' => 'Type d\'accès'))
            ->add('dateDebut', DateType::class, array(
                'years' => range(date('Y'), date('Y') + 5),
                'label' => 'Date de début de la mission dans la ZRR'))
            ->add('dateFin', DateType::class, array(
                'years' => range(date('Y'), date('Y') + 10),
                'label' => 'Date de fin de la mission dans la ZRR'));

        $builder
            ->add('domainescientifique', EntityType::class,
                array('class' => 'ZRRCandidatureBundle:Domainescientifique',
                    'choice_label' => 'nom',
                    'mapped' => false,
                    'required' => false,
                    'multiple' => false,
                    'placeholder' => 'Sélectionnez un domaine scientifique',));

        $builder->get('domainescientifique')->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) {
                //dump($event->getForm());
                //dump($event->getForm()->getData());
                $form = $event->getForm();
                $this->addDisciplineScientifiqueFild($form->getParent(), $form->getData());

            }
        );
        $builder->addEventListener(
            FormEvents::POST_SET_DATA,
            function (FormEvent $event){
                $data = $event->getData();
                /* @var $disciplinescientifique Disciplinescientifique */
                $disciplinescientifique = $data->getDisciplinescientifique();
                $form = $event->getForm();

                if($disciplinescientifique){
                    $domainescientifique = $disciplinescientifique->getDomainescientifique();
                    $this->addDisciplineScientifiqueFild($form, $domainescientifique);
                    $form->get('domainescientifique')->setData($domainescientifique);
                }else{
                    $this->addDisciplineScientifiqueFild($form, null);
                }
            }
        );
        $builder
            ->add('poste', TextType::class, array('label' => 'Intitulé du poste'))
            ->add('resume', TextareaType::class, array('label' => 'Résumé de la mission et de l\'activité (sujet, thème) prévue au sein de la ZRR'))
            ->add('document',DocumentType::class, array(
                'required'=>false,
                'mapped' => false,
                //'by_reference'=>false
            ))
            ->add('save',      SubmitType::class, array('label' => 'Enregistrer'));

    }


    /**
     * Rajoute un champ Discipline scientifique au formulaire
     * @param FormInterface $form
     * @param Domainescientifique $domainescientifique
     */
    private function addDisciplineScientifiqueFild(FormInterface $form, Domainescientifique $domainescientifique = null){

        $form->add('disciplinescientifique', EntityType::class, array(
            'class' => 'ZRRCandidatureBundle:Disciplinescientifique',
            'placeholder' => $domainescientifique ? 'Sélectionnez une discipline scientifique' : 'Sélectionnez dabord un domaine scientifique',
            'mapped' => false,
            'required' => false,
            'choices' =>  $domainescientifique ? $domainescientifique->getDisciplinescientifiques() : []));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ZRR\CandidatureBundle\Entity\Activite'
        ));
    }

    public function getName()
    {
    return 'zrr_candidaturebundle_activite';
}
}
