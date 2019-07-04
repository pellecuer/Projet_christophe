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
use App\Entity\Activity;
use App\Entity\Project;
use App\Repository\ActivityRepository;
use App\Repository\ProjectRepository;


/**
 * @Route("/activity")
 */
class ActivityController extends AbstractController
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
     * @Route("/show/{id}", name="show")
     */
    public function show(ActivityRepository $repository, Project $project)
    {               
        $currentMonth = new \DateTime('now');
        $startProjectDate = $project->getStartDate();       
        $endProjectDate = $project->getEndDate();
        
        $intervalOneMonth = new \DateInterval('P1M');

        // Calendars []
        $calendars = [];
        $dt = \DateTimeImmutable::createFromMutable($startProjectDate);
        while ($dt < $endProjectDate){            
            $calendars[] = $dt;            
            $dt = $dt->add($intervalOneMonth);
        }

        //$arrayProfiles[]
        $arrayProfiles = [];        
        $profiles = $repository->findProfiles();
        foreach($profiles as $Eachprofile) {            
            $arrayProfiles[] = $Eachprofile['profile'];            
        }
        
        foreach($arrayProfiles as $profile){  
            $col2 = [];
            foreach ($calendars as $date) {                
                $data = $repository->findOneByDateByProjectByProfile($date, $project, $profile); 
                $col2[] = $data ? $data: NULL;
            }           
            $activities[] = [$profile, $col2];                    
        }  
        

        //Array Key of current Month
        foreach ($calendars as $calendar)
            $stringCalendars[] = $calendar->format('M-y'); 
        $key = array_search($currentMonth->format('M-y'), $stringCalendars)+1; 
        
        $nbColumns = count($stringCalendars)+1;
        // dump($nbColumns);die;

        return $this->render('index/show.html.twig', [            
            'calendars' => $stringCalendars,
            'key' => $key,
            'nbColumns' =>$nbColumns,
            'currentMonth' => $currentMonth->format('M-y'),
            'activities' => $activities,
            'projectName' =>$project->getName()
        ]);
    }
                     
          

        
        /**
     * @Route("/all", name="all")
     */
    public function showAll(ActivityRepository $repository)
    {   
        $activity = $repository->findAll();      

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
        $activity = new Activity;    
        $activity->setProfile('Junior');
        $dateTime = new \DateTime('2019-02-05 12:00:00');
        $activity ->setDate($dateTime);
        $activity ->setRank(4);
        $activity->setStatus('Prévisionnel');
        $activity->setType('Quality E'); 

        $this->em->persist($activity);
        $this->em->flush();
        $this->addFlash('success', 'Nouvelle activité crée avec succès');

        return new Response('Nouvelle activité '. $activity->getId());

    }

    /**
     * @Route("/update", name="update")
     */
    public function update(Request $request, ActivityRepository $repository)
    {        
        $id = $request->request->get('id');
        $rank = $request->request->get('rank');

        //If id == 0, create new Activity and verify it doesn't exist by searching
    
        $date = $request->request->get('emptyMonth');   
        $projectName =  $request->request->get('projectName');
        $profile = $request->request->get('profile');
        $project = $this->getDoctrine()
            ->getRepository(Project::class)
            ->findOneBy([
                'name' =>$projectName
            ]);
            

        //Search if Activity exist           
        $dateTime = \DateTime::createFromFormat('M-y', $date);
        $activity = $repository->findOneByDateByProjectByProfile($dateTime, $project, $profile);
        
        if ($activity) {
            $activity->setRank($rank);
            $this->em->persist($activity);
            $this->em->flush();
        } else {
            $activity = new Activity;    
            $activity->setProfile($profile);          
            $activity->setDate($dateTime);
            $activity->setRank($rank);
            $activity->setProject($project);
            $activity->setStatus('Prévisionnel');
            $activity->setType('Indéterminé');
            $this->em->persist($activity);
            $this->em->flush();
        }
        

        $response = new Response(json_encode([
            'id' =>  $id,
            'rank'=> $rank
        ]));
        $response->headers->set('Content-Type', 'application/json');
        return $response;

    }
    
}