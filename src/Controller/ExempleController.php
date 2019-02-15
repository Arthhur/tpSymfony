<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Materiels ;

class ExempleController extends AbstractController
{
    /**
     * @Route("/materiel", name="materiel")
     */
    public function show(EntityManagerInterface $em) {
        $materiels = $em->getRepository(Materiels::class)->findAll();

        return $this->render('materiel/index.html.twig', [
            'materiels' => $materiels,
        ]) ;
    }

    /**
     * @Route("/materielForm", name="materielForm")
     */
    public function add(Request $request) {
        
        $materiel = new Materiels();

        $form = $this->createFormBuilder($materiel)
            ->add('Nom')
            ->add('Qte')
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();   
            $em->persist($materiel);
            $em->flush();
            return $this->redirectToRoute('materiel');
        }


        return $this->render('materiel_form/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/materielUpdate/{id<\d+>}", name = "materielUpdate")
     */
    public function update($id, Request $request) {
        $entityManager = $this->getDoctrine()->getManager();
        $materiel = $entityManager->getRepository(Materiels::class)->find($id);

        $mat = new Materiels();

        $form = $this->createFormBuilder($mat)
            ->add('Nom')
            ->add('Qte')
            ->getForm();

        $form->handleRequest($request);

        if (!$materiel) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();   
            $materiel->setNom($mat->getNom()) ;
            $materiel->setQte($mat->getQte()) ;
            $em->flush();
            return $this->redirectToRoute('materiel');
        }

        return $this->render('materiel/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/materielDelete/{id<\d+>}", name = "materielDelete")
     */
    public function delete(Request $request, Materiels $materiel) {
        $em = $this->getDoctrine()->getManager();
        
        $em->remove($materiel);
        $em->flush();

        // redirige la page
        return $this->redirectToRoute('materiel');
    }
}
