<?php

namespace App\Service;

use App\Form\ProjectSearchType;
use App\Entity\ProjectSearch;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Form\FormFactoryInterface;

class SearchForm
{ 
    private $form; 
    
    private $router;
    
    private $formFactory;
    
    public function __construct(UrlGeneratorInterface $router, FormFactoryInterface $formFactory) {
    
        $search = new ProjectSearch();        
        $this->router = $router;        
        $this->formFactory = $formFactory;        
        $this->form = $this->formFactory->create(ProjectSearchType::class, $search, array(
                'attr' => array(
                    'action' => $this->router->generate('projectSearch')
                )
            )
        );
    }
 
    public function getForm() {
    return $this->form;
    }
}