<?php

namespace App\Controller;

use App\Entity\SoftSkills;
use App\Form\SoftSkillsType;
use App\Repository\SoftSkillsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/soft/skills')]
class SoftSkillsController extends AbstractController
{
    #[Route('/', name: 'app_soft_skills_index', methods: ['GET'])]
    public function index(SoftSkillsRepository $softSkillsRepository): Response
    {
        return $this->render('soft_skills/index.html.twig', [
            'soft_skills' => $softSkillsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_soft_skills_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $softSkill = new SoftSkills();
        $form = $this->createForm(SoftSkillsType::class, $softSkill);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($softSkill);
            $entityManager->flush();

            return $this->redirectToRoute('app_soft_skills_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('soft_skills/new.html.twig', [
            'soft_skill' => $softSkill,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_soft_skills_show', methods: ['GET'])]
    public function show(SoftSkills $softSkill): Response
    {
        return $this->render('soft_skills/show.html.twig', [
            'soft_skill' => $softSkill,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_soft_skills_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, SoftSkills $softSkill, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SoftSkillsType::class, $softSkill);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_soft_skills_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('soft_skills/edit.html.twig', [
            'soft_skill' => $softSkill,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_soft_skills_delete', methods: ['POST'])]
    public function delete(Request $request, SoftSkills $softSkill, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$softSkill->getId(), $request->request->get('_token'))) {
            $entityManager->remove($softSkill);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_soft_skills_index', [], Response::HTTP_SEE_OTHER);
    }
}
