<?php

namespace App\Controller;

use App\Entity\Tjm;
use App\Form\TjmType;
use App\Repository\TjmRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/tjm")
 */
class TjmController extends AbstractController
{
    /**
     * @Route("/", name="tjm_index", methods={"GET"})
     */
    public function index(TjmRepository $tjmRepository): Response
    {
        return $this->render('tjm/index.html.twig', [
            'tjms' => $tjmRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="tjm_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $tjm = new Tjm();
        $form = $this->createForm(TjmType::class, $tjm);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($tjm);
            $entityManager->flush();

            return $this->redirectToRoute('tjm_index');
        }

        return $this->render('tjm/new.html.twig', [
            'tjm' => $tjm,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="tjm_show", methods={"GET"})
     */
    public function show(Tjm $tjm): Response
    {
        return $this->render('tjm/show.html.twig', [
            'tjm' => $tjm,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="tjm_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Tjm $tjm): Response
    {
        $form = $this->createForm(TjmType::class, $tjm);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('tjm_index', [
                'id' => $tjm->getId(),
            ]);
        }

        return $this->render('tjm/edit.html.twig', [
            'tjm' => $tjm,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="tjm_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Tjm $tjm): Response
    {
        if ($this->isCsrfTokenValid('delete'.$tjm->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($tjm);
            $entityManager->flush();
        }

        return $this->redirectToRoute('tjm_index');
    }
}
