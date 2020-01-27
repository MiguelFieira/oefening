<?php

namespace App\Controller;

use App\Entity\Wedstrijden;
use App\Form\WedstrijdenType;
use App\Repository\WedstrijdenRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/wedstrijden")
 */
class WedstrijdenController extends AbstractController
{
    /**
     * @Route("/", name="wedstrijden_index", methods={"GET"})
     */
    public function index(WedstrijdenRepository $wedstrijdenRepository): Response
    {
        return $this->render('wedstrijden/index.html.twig', [
            'wedstrijdens' => $wedstrijdenRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="wedstrijden_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $wedstrijden = new Wedstrijden();
        $form = $this->createForm(WedstrijdenType::class, $wedstrijden);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($wedstrijden);
            $entityManager->flush();

            return $this->redirectToRoute('wedstrijden_index');
        }

        return $this->render('wedstrijden/new.html.twig', [
            'wedstrijden' => $wedstrijden,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="wedstrijden_show", methods={"GET"})
     */
    public function show(Wedstrijden $wedstrijden): Response
    {
        return $this->render('wedstrijden/show.html.twig', [
            'wedstrijden' => $wedstrijden,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="wedstrijden_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Wedstrijden $wedstrijden): Response
    {
        $form = $this->createForm(WedstrijdenType::class, $wedstrijden);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('wedstrijden_index');
        }

        return $this->render('wedstrijden/edit.html.twig', [
            'wedstrijden' => $wedstrijden,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="wedstrijden_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Wedstrijden $wedstrijden): Response
    {
        if ($this->isCsrfTokenValid('delete'.$wedstrijden->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($wedstrijden);
            $entityManager->flush();
        }

        return $this->redirectToRoute('wedstrijden_index');
    }
}
