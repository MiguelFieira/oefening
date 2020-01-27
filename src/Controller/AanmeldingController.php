<?php

namespace App\Controller;

use App\Entity\Aanmelding;
use App\Form\AanmeldingType;
use App\Repository\AanmeldingRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/aanmelding")
 */
class AanmeldingController extends AbstractController
{
    /**
     * @Route("/", name="aanmelding_index", methods={"GET"})
     */
    public function index(AanmeldingRepository $aanmeldingRepository): Response
    {
        return $this->render('aanmelding/index.html.twig', [
            'aanmeldings' => $aanmeldingRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="aanmelding_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $aanmelding = new Aanmelding();
        $form = $this->createForm(AanmeldingType::class, $aanmelding);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $aanmelding -> getToernooi()->
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($aanmelding);
            $entityManager->flush();

            return $this->redirectToRoute('aanmelding_index');
        }

        return $this->render('aanmelding/new.html.twig', [
            'aanmelding' => $aanmelding,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="aanmelding_show", methods={"GET"})
     */
    public function show(Aanmelding $aanmelding): Response
    {
        return $this->render('aanmelding/show.html.twig', [
            'aanmelding' => $aanmelding,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="aanmelding_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Aanmelding $aanmelding): Response
    {
        $form = $this->createForm(AanmeldingType::class, $aanmelding);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('aanmelding_index');
        }

        return $this->render('aanmelding/edit.html.twig', [
            'aanmelding' => $aanmelding,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="aanmelding_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Aanmelding $aanmelding): Response
    {
        if ($this->isCsrfTokenValid('delete'.$aanmelding->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($aanmelding);
            $entityManager->flush();
        }

        return $this->redirectToRoute('aanmelding_index');
    }
}
