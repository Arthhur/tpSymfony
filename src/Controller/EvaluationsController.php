<?php

namespace App\Controller;

use App\Entity\Evaluations;
use App\Form\EvaluationsType;
use App\Repository\EvaluationsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/evaluations")
 */
class EvaluationsController extends AbstractController
{
    /**
     * @Route("/", name="evaluations_index", methods={"GET"})
     */
    public function index(EvaluationsRepository $evaluationsRepository): Response
    {
        return $this->render('evaluations/index.html.twig', [
            'evaluations' => $evaluationsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="evaluations_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $evaluation = new Evaluations();
        $form = $this->createForm(EvaluationsType::class, $evaluation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($evaluation);
            $entityManager->flush();

            return $this->redirectToRoute('evaluations_index');
        }

        return $this->render('evaluations/new.html.twig', [
            'evaluation' => $evaluation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="evaluations_show", methods={"GET"})
     */
    public function show(Evaluations $evaluation): Response
    {
        return $this->render('evaluations/show.html.twig', [
            'evaluation' => $evaluation,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="evaluations_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Evaluations $evaluation): Response
    {
        $form = $this->createForm(EvaluationsType::class, $evaluation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('evaluations_index', [
                'id' => $evaluation->getId(),
            ]);
        }

        return $this->render('evaluations/edit.html.twig', [
            'evaluation' => $evaluation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="evaluations_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Evaluations $evaluation): Response
    {
        if ($this->isCsrfTokenValid('delete'.$evaluation->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($evaluation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('evaluations_index');
    }
}
