<?php

namespace App\Form;

use App\Entity\ProjectSearch;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Translation\TranslatorInterface;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class ProjectSearchType extends AbstractType
{

    private $router;
    protected $translator;
    
    public function __construct(TranslatorInterface $translator, UrlGeneratorInterface $router)
    {
        $this->router = $router;
        $this->translator = $translator;
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
                    'placeholder' => $this->translator->transChoice('project name', 1),
                    'id' => 'searchNameInput',
                    'class' => 'js-project-autocomplete',
                    'data-autocomplete-url' => $this->router->generate('auto_complete_projects')
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
