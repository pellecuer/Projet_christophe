<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Project;
use App\Repository\ProjectRepository;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index(ProjectRepository $repository)
    {

        $lastProjects = $repository->findLastFive();        

        return $this->render('home/index.html.twig', [
            'projects' => $lastProjects,
        ]);
    }
}
