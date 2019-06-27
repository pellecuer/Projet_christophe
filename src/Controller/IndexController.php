<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\DBAL\Driver\Connection;
use Doctrine\ORM\EntityManagerInterface;
use \PDO;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Project;
use App\Repository\ProjectRepository;



class IndexController extends AbstractController
{
    
    public function __construct(EntityManagerInterface $em)
    {    
        $this->em = $em;
    }

    
    // /**
    //  * @Route("/info", name="info")
    //  */
    // public function info()
    // {        
    //     phpinfo();
    //     return new Response();
    // }

    /**
     * @Route("/show", name="info")
     */
    public function show(ProjectRepository $project)
    {   
        $projects = $project->findAll();        

        $currentMonth = new \DateTime('now');
        $startProjectDate = new \DateTimeImmutable('2019-01-01');
        $endProjectDate = new \DateTime('2019-12-31');
        $intervalOneMonth = new \DateInterval('P1M');

        // Calendars []
        $calendars = [];
        $dt = clone $startProjectDate;
        while ($dt < $endProjectDate){            
            $calendars[] = $dt;            
            $dt = $dt->add($intervalOneMonth);
        }     

        //$rrayProfiles[]
        $arrayProfiles = [];
        $profiles = $project->findProfiles();
        foreach($profiles as $Eachprofile) {            
            $arrayProfiles[] = $Eachprofile['profile'];            
        } 
        
        foreach($arrayProfiles as $profile){  
            $col2 = [];
            foreach ($calendars as $date) {
                $data = $project->findOneByDateByProfile($date, $profile);                 
                $rank = $data ? $data->getRank(): NULL;            
                $col2[] = $rank;
            }           
            $works[] = [$profile, $col2];                      
        }
        // dump($works);die; 

        //Array Key of current Month
        foreach ($calendars as $calendar)
            $stringCalendars[] = $calendar->format('M-y'); 
        $key = array_search($currentMonth->format('M-y'), $stringCalendars)+1;             

        return $this->render('index/show.html.twig', [            
            'calendars' => $stringCalendars,
            'key' => $key,
            'currentMonth' => $currentMonth->format('M-y'),
            'works' => $works
        ]);
    }
                     
          

        
        /**
     * @Route("/all", name="all")
     */
    public function showAll(ProjectRepository $project)
    {   
        $projects = $project->findAll();
        dump ($projects);die;        

        return new Response();
    }
    
    /**
     * @Route("/index", name="index")
     */
    public function index(Request $request)
    {        
        $currentMonth = new \DateTime('now');
        $startProjectDate = new \DateTimeImmutable('2019-01-01');
        $endProjectDate = new \DateTime('2019-11-01');
        $intervalOneMonth = new \DateInterval('P1M');

        // calendar
        $calendars = [];
        $dt = clone $startProjectDate;
        while ($dt < $endProjectDate) {            
            $calendars[] = $dt->format('M-y');            
            $dt = $dt->add($intervalOneMonth);
        }
        //get projects


        //works
        $works = [            
            ['Gestion de projet', 1, 1, 2, 2, 0, 2, 3, 4, 4, 4],
            ['Junior', 1, 1, 2, 2, 0, 2, 3, 4, 4, 4],
            ['Design', 1, 1, 2, 2, 0, 2, 3, 4, 4, 4],
            ['Lead', 1, 1, 2, 2, 0, 2, 3, 4, 4, 4],
            ['Confirmé', 15, 1, 2, 2, 0, 2, 3, 4, 4, 4],            
            ['Quality Assurance', 1, 1, 2, 2, 0, 2, 3, 4, 4, 4],
            ['Projet Web', 1, 1, 2, 2, 0, 2, 3, 4, 4, 4],
            ['Projet Mobile Android', 3, 1, 2, 2, 0, 2, 3, 4, 4, 4],          
        ];  

        $key = array_search($currentMonth->format('M-y'), $calendars)+1;
        dump($key);die;

        return $this->render('index/index.html.twig', [            
            'calendars' => $calendars,
            'key' => $key,
            'currentMonth' => $currentMonth->format('M-y'),
            'works' => $works
        ]);
    }

    /**
     * @Route("/ajax", name="ajax")
     */
    public function ajax(Request $request)
    {   
        // $currentMonth = $request->request->get('currentMonth');
        
        $works = [            
            ['Gestion de projet', 1, 1, 2, 2, 0, 2, 3, 4, 4, 4],
            ['Junior', 1, 1, 2, 2, 0, 2, 3, 4, 4, 4],
            ['Design', 1, 1, 2, 2, 0, 2, 3, 4, 4, 4],
            ['Lead', 1, 1, 2, 2, 0, 2, 3, 4, 4, 4],
            ['Confirmé', 15, 1, 2, 2, 0, 2, 3, 4, 4, 4],            
            ['Quality Assurance', 1, 1, 2, 2, 0, 2, 3, 4, 4, 4],
            ['Projet Web', 1, 1, 2, 2, 0, 2, 3, 4, 4, 4],
            ['Projet Mobile Android', 3, 1, 2, 2, 0, 2, 3, 4, 4, 4],           
        ];                

        return $this->json(
            [ 
                'data' => $works,              
            ]
        );
    }


    /**
     * @Route("/response", name="response")
     */
    public function response(Request $request)
    {         
        //get new rank
        $rank = $request->request->get('rank');


        $response = new Response(json_encode([
            'rank' =>  $rank
        ]));

        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    /**
     * @Route("/new", name="new")
     */
    public function new()
    {
        $project = new Project;
        $project->setName('Projet2');
        $project->setProfile('Junior');
        $dateTime = new \DateTime('2019-02-05 12:00:00');
        $project ->setDate($dateTime);
        $project ->setRank(4);
        $project->setStatus('Prévisionnel');
        $project->setType('Quality E');

        //dump($project);die;

        $this->em->persist($project);
        $this->em->flush();
        $this->addFlash('success', 'Projet crée avec succès');

        return new Response('Nouveau projet enregistré '. $project->getId());

    }


    


}
