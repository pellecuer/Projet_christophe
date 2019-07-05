<?php

namespace App\Controller;

use App\Entity\Pole;
use App\Form\PoleType;
use App\Repository\PoleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/pole")
 */
class PoleController extends AbstractController
{
    /**
     * @Route("/", name="pole_index", methods={"GET"})
     */
    public function index(PoleRepository $poleRepository): Response
    {
        return $this->render('pole/index.html.twig', [
            'poles' => $poleRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="pole_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $pole = new Pole();
        $form = $this->createForm(PoleType::class, $pole);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($pole);
            $entityManager->flush();

            return $this->redirectToRoute('pole_index');
        }

        return $this->render('pole/new.html.twig', [
            'pole' => $pole,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="pole_show", methods={"GET"})
     */
    public function show(Pole $pole): Response
    {
        return $this->render('pole/show.html.twig', [
            'pole' => $pole,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="pole_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Pole $pole): Response
    {
        $form = $this->createForm(PoleType::class, $pole);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('pole_index', [
                'id' => $pole->getId(),
            ]);
        }

        return $this->render('pole/edit.html.twig', [
            'pole' => $pole,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="pole_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Pole $pole): Response
    {
        if ($this->isCsrfTokenValid('delete'.$pole->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($pole);
            $entityManager->flush();
        }

        return $this->redirectToRoute('pole_index');
    }
}
