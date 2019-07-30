<?php

namespace App\Form;

use App\Entity\Tjm;
use App\Entity\Pole;
use App\Entity\Project;
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
                'choice_label' => function(Pole $pole) {
                    return sprintf('(%d) %s', $pole->getId(), $pole->getName());
                },
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
