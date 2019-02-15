<?php

namespace App\Controller;

use App\Entity\Catalogues;
use App\Form\CataloguesType;
use App\Repository\CataloguesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/catalogues")
 */
class CataloguesController extends AbstractController
{
    /**
     * @Route("/", name="catalogues_index", methods={"GET"})
     */
    public function index(CataloguesRepository $cataloguesRepository): Response
    {
        return $this->render('catalogues/index.html.twig', [
            'catalogues' => $cataloguesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="catalogues_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $catalogue = new Catalogues();
        $form = $this->createForm(CataloguesType::class, $catalogue);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($catalogue);
            $entityManager->flush();

            return $this->redirectToRoute('catalogues_index');
        }

        return $this->render('catalogues/new.html.twig', [
            'catalogue' => $catalogue,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="catalogues_show", methods={"GET"})
     */
    public function show(Catalogues $catalogue): Response
    {
        return $this->render('catalogues/show.html.twig', [
            'catalogue' => $catalogue,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="catalogues_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Catalogues $catalogue): Response
    {
        $form = $this->createForm(CataloguesType::class, $catalogue);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('catalogues_index', [
                'id' => $catalogue->getId(),
            ]);
        }

        return $this->render('catalogues/edit.html.twig', [
            'catalogue' => $catalogue,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="catalogues_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Catalogues $catalogue): Response
    {
        if ($this->isCsrfTokenValid('delete'.$catalogue->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($catalogue);
            $entityManager->flush();
        }

        return $this->redirectToRoute('catalogues_index');
    }
}
