<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Project;
use App\Repository\ProjectRepository;
use App\Entity\ProjectSearch;
use App\Form\ProjectSearchType;


class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index(ProjectRepository $repository, Request $request)
    {        
        $search = new ProjectSearch();
        $form =$this->createForm(ProjectSearchType::class, $search);
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
}
