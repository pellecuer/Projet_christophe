<?php

namespace App\Controller;

use App\Entity\Collaborators;
use App\Form\CollaboratorsType;
use App\Repository\CollaboratorsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/collaborators")
 */
class CollaboratorsController extends AbstractController
{
    /**
     * @Route("/", name="collaborators_index", methods={"GET"})
     */
    public function index(CollaboratorsRepository $collaboratorsRepository): Response
    {
        return $this->render('collaborators/index.html.twig', [
            'collaborators' => $collaboratorsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="collaborators_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $collaborator = new Collaborators();
        $form = $this->createForm(CollaboratorsType::class, $collaborator);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($collaborator);
            $entityManager->flush();

            return $this->redirectToRoute('collaborators_index');
        }

        return $this->render('collaborators/new.html.twig', [
            'collaborator' => $collaborator,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="collaborators_show", methods={"GET"})
     */
    public function show(Collaborators $collaborator): Response
    {
        return $this->render('collaborators/show.html.twig', [
            'collaborator' => $collaborator,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="collaborators_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Collaborators $collaborator): Response
    {
        $form = $this->createForm(CollaboratorsType::class, $collaborator);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('collaborators_index', [
                'id' => $collaborator->getId(),
            ]);
        }

        return $this->render('collaborators/edit.html.twig', [
            'collaborator' => $collaborator,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="collaborators_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Collaborators $collaborator): Response
    {
        if ($this->isCsrfTokenValid('delete'.$collaborator->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($collaborator);
            $entityManager->flush();
        }

        return $this->redirectToRoute('collaborators_index');
    }
}
