<?php

namespace ZRR\CandidatureBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DossierType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('activite', ActiviteEditType::class);

        $builder
            ->add('zrr', ZrrEditType::class)
            ->add('etatDossier',TextType::class, array("label"=>"état du dossier"))
            ->add('avisResp',TextAreaType::class, array("label"=>"Avis motivé du responsable de la ZRR"))
            ->add('avisChef',TextAreaType::class, array("label"=>"Avis du chef d'établissement ou délégué à la sécurité (FSD, officier de sécurité, etc.)"))
            ->add('avisMinistere',TextAreaType::class, array("label"=>"Avis du ministère de la tutelle"))
            ->add('commentaire',TextAreaType::class, array("label"=>"Commentaires, précisions sur poste/stage du demandeur"))
            ->add('save',      SubmitType::class, array('label' => 'Valider'));
    }

    public function getParent()
    {
        return DossierCandidatEditType::class;
    }



}
