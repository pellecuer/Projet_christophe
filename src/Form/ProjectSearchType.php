<?php

namespace App\Form;

use App\Entity\ProjectSearch;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ProjectSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date', DateType::class, [
                'required' => false,
                'label' => false,
                'widget' => 'single_text',
            ])
            ->add('name', TextType::class, [
                'required' => false,
                'label' => false,
                'attr' => [
                    'placeholder' => 'Premières lettres du projet'
                ],                
                'trim' => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ProjectSearch::class,
            'method' => 'get',
            'csrf_protection' =>false
        ]);
    }

    public function getBlockPrefix()
    {
        return '';
    }
}
