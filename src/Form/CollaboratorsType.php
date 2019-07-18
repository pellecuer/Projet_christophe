<?php

namespace App\Form;

use App\Entity\Collaborators;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CollaboratorsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', null, [
                'label' =>'Prénom'
            ])
            ->add('lastName', null, [
                'label' =>'Nom'
            ])
            ->add('codeFirstName', null, [
                'label' =>'Code'
            ])
            ->add('email', null, [
                'label' =>'Email'
            ])->add('Profile', null, [
                'label' =>'Profil'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Collaborators::class,
        ]);
    }
}
