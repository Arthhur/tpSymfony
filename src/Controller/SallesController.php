<?php

namespace App\Controller;

use App\Entity\Salles;
use App\Form\SallesType;
use App\Repository\SallesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/salles")
 */
class SallesController extends AbstractController
{
    /**
     * @Route("/", name="salles_index", methods={"GET"})
     */
    public function index(SallesRepository $sallesRepository): Response
    {
        return $this->render('salles/index.html.twig', [
            'salles' => $sallesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="salles_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $salle = new Salles();
        $form = $this->createForm(SallesType::class, $salle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($salle);
            $entityManager->flush();

            return $this->redirectToRoute('salles_index');
        }

        return $this->render('salles/new.html.twig', [
            'salle' => $salle,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="salles_show", methods={"GET"})
     */
    public function show(Salles $salle): Response
    {
        return $this->render('salles/show.html.twig', [
            'salle' => $salle,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="salles_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Salles $salle): Response
    {
        $form = $this->createForm(SallesType::class, $salle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('salles_index', [
                'id' => $salle->getId(),
            ]);
        }

        return $this->render('salles/edit.html.twig', [
            'salle' => $salle,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="salles_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Salles $salle): Response
    {
        if ($this->isCsrfTokenValid('delete'.$salle->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($salle);
            $entityManager->flush();
        }

        return $this->redirectToRoute('salles_index');
    }
}
