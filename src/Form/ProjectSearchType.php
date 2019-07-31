<?php

namespace App\Form;

use App\Entity\ProjectSearch;
use App\Repository\ProjectRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class ProjectSearchType extends AbstractType
{

    private $router;
    
    public function __construct(ProjectRepository $projectRepository, UrlGeneratorInterface $router)
    {
        $this->router = $router;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder            
            ->add('date', DateType::class, [                
                'widget' => 'single_text',
                'required' => false,
                'label' => false,
            ])
            
            ->add('name', TextType::class, [
                'required' => false,
                'label' => false,
                'attr' => [
                    'placeholder' => 'Nom du projet',
                    'id' => 'searchNameInput',
                    'class' => 'js-project-autocomplete'
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
            'csrf_protection' =>false,
            'attr' => [
                'data-autocomplete-url' => $this->router->generate('auto_complete_projects')
            ]
        ]);
    }

    public function getBlockPrefix()
    {
        return '';
    }
}
