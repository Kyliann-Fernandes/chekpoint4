<?php

namespace App\Controller;

use App\Entity\Moi;
use App\Form\MoiType;
use App\Repository\MoiRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/moi')]
class MoiController extends AbstractController
{
    #[Route('/', name: 'app_moi_index', methods: ['GET'])]
    public function index(MoiRepository $moiRepository): Response
    {
        return $this->render('moi/index.html.twig', [
            'mois' => $moiRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_moi_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $moi = new Moi();
        $form = $this->createForm(MoiType::class, $moi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($moi);
            $entityManager->flush();

            return $this->redirectToRoute('app_moi_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('moi/new.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_moi_show', methods: ['GET'])]
    public function show(Moi $moi): Response
    {
        return $this->render('moi/show.html.twig', [
            'moi' => $moi,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_moi_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Moi $moi, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(MoiType::class, $moi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_moi_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('moi/edit.html.twig', [
            'moi' => $moi,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_moi_delete', methods: ['POST'])]
    public function delete(Request $request, Moi $moi, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$moi->getId(), $request->request->get('_token'))) {
            $entityManager->remove($moi);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_moi_index', [], Response::HTTP_SEE_OTHER);
    }
}
