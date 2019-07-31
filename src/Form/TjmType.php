<?php

namespace App\Form;

use App\Entity\Tjm;
use App\Entity\Pole;
use App\Entity\Project;
use App\Repository\PoleRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TjmType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder            
            ->add('pole', EntityType::class, [
                'class' => Pole::class,
                'query_builder' => function (PoleRepository $repository) {
                    return $repository->createQueryBuilder('p')
                        ->orderBy('p.name', 'ASC');
                },
                'choice_label' => 'name',
                'placeholder' => 'Choississez un pole'
            ])
            ->add('amount', null, [
                'label' => 'Montant',
                'attr' => ['placeholder' => 'Entrez un chiffre'],
            ])                      
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Tjm::class,
        ]);
    }
}
