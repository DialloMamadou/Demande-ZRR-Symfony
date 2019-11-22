<?php

/*
 * This file is part of the FOSUserBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ZRR\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;
use ZRR\CandidatureBundle\Form\CandidatNomType;
use ZRR\CandidatureBundle\Form\SecretaireType;

class RegistrationFormType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        //parent::buildForm($builder, $options);
        $builder
            ->add('roles', CollectionType::class, array(
                'entry_type' => ChoiceType::class,
                'entry_options' => array(
                    'choices'  => array(
                        'Candidat' => 'ROLE_CDD',
                        'Responsable' => 'ROLE_RESP',
                        'Administrateur' => 'ROLE_ADMIN',
                        'Secrétaire'=>'ROLE_SECR'
                    ),
                    'label' => 'role'),
                'label' => false
            ))
            ->add('candidat', CandidatNomType::class, array('by_reference'=>false));
        ;

        $newform=function(FormInterface $form,$roles){

            if (in_array('ROLE_SECR', $roles)) {
                $form->add('secretaire', SecretaireType::class,
                    array('by_reference' => false));
            } else {
                $form->add('candidat', CandidatNomType::class,
                    array('by_reference' => false, 'label'=>'candidat'));

            }

        };
        /*$builder->addEventListener(
            FormEvents::POST_SET_DATA,
            function (FormEvent $event) use ($newform){
                $form = $event->getForm();

                $data = $event->getData();
                echo var_dump($data);
                $newform($form, $data->getRoles());

            }
        );

        $builder->get('roles')->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) use ($newform){
                $form = $event->getForm();

                $data = $event->getData();
                $newform($form->getParent(), $data->getRoles());

            }
        );*/

        /*->add('roles', ChoiceType::class, array(
        'choices'  => array(
            'Candidat' => 'ROLE_CDD',
            'Responsable' => 'ROLE_RESP',
            'Administrateur' => 'ROLE_ADMIN'
        ),
        'expanded'=>false,
        'multiple'     => true
    ));*/
        //->remove('password')

        $builder->remove('plainPassword');
        /*->add('roles', ChoiceType::class, array(
        'choices'  => array(
            'Candidat' => 'ROLE_CDD',
            'Responsable' => 'ROLE_RESP',
            'Administrateur' => 'ROLE_ADMIN'
        ),
        'expanded'=>false,
        'multiple'     => true
    ))->add('email', EmailType::class, array('label' => 'form.email', 'translation_domain' => 'FOSUserBundle'))
        ->add('username', null, array('label' => 'form.username', 'translation_domain' => 'FOSUserBundle'))
        ->add('plainPassword', RepeatedType::class, array(
            'type' => PasswordType::class,
            'options' => array(
                'translation_domain' => 'FOSUserBundle',
                'attr' => array(
                    'autocomplete' => 'new-password',
                ),
            ),
            'first_options' => array('label' => 'form.password'),
            'second_options' => array('label' => 'form.password_confirmation'),
            'invalid_message' => 'fos_user.password.mismatch',
        ))*/


    }

    // BC for SF < 3.0

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->getBlockPrefix();
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'zrr_user_registration';
    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';
    }

}
