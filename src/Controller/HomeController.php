<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Project;
use App\Repository\ProjectRepository;
use App\Entity\ProjectSearch;
use App\Form\ProjectSearchType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use App\Service\SearchForm;
use Symfony\Component\HttpFoundation\Response;



class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(ProjectRepository $repository, Request $request)
    {        
        $search = new ProjectSearch();
        $form = $this->createForm(ProjectSearchType::class, $search);
        $form->handleRequest($request);        

        if ($form->isSubmitted() && $form->isValid()) {
            $arrayTitle = 'Résultats de votre recherche';
        }
        else {
            $arrayTitle = 'Les 5 derniers projets';
        }
             
        $projects = $repository->findLikeProjects($search);

        return $this->render('home/index.html.twig', [
            'projects' => $projects,
            'form' =>$form->createView(),
            'Arraytitle' => $arrayTitle
        ]);
    }

    /**
     * @Route("/search", name="projectSearch")
     * @Method({"POST"})
     */
    public function searchForm(ProjectRepository $repository, SearchForm $searchForm, Request $request)
    {
        
        $form = $searchForm->getForm();
        
        $form->handleRequest($request);          

        if ($form->isSubmitted() && $form->isValid()) {
            $arrayTitle = 'Résultats de votre recherche';

            $search = new ProjectSearch();
            $name = $form->get('name')->getData();
            $date = $form->get('date')->getData();
            $search->setName($name);
            $search->setDate($date);

        }
        else {
            $arrayTitle = 'Les 5 derniers projets';
        }

        $projects = $repository->findLikeProjects($search);
    
        return  $this->render('home/index.html.twig', [
            'projects' => $projects,
            'Arraytitle' => $arrayTitle
        ]);


    }



}
