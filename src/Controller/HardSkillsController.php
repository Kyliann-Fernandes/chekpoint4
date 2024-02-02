<?php

namespace App\Controller;

use App\Entity\HardSkills;
use App\Form\HardSkillsType;
use App\Repository\HardSkillsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/hard/skills')]
class HardSkillsController extends AbstractController
{
    #[Route('/', name: 'app_hard_skills_index', methods: ['GET'])]
    public function index(HardSkillsRepository $hardSkillsRepository): Response
    {
        return $this->render('hard_skills/index.html.twig', [
            'hard_skills' => $hardSkillsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_hard_skills_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $hardSkill = new HardSkills();
        $form = $this->createForm(HardSkillsType::class, $hardSkill);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($hardSkill);
            $entityManager->flush();

            return $this->redirectToRoute('app_hard_skills_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('hard_skills/new.html.twig', [
            'hard_skill' => $hardSkill,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_hard_skills_show', methods: ['GET'])]
    public function show(HardSkills $hardSkill): Response
    {
        return $this->render('hard_skills/show.html.twig', [
            'hard_skill' => $hardSkill,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_hard_skills_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, HardSkills $hardSkill, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(HardSkillsType::class, $hardSkill);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_hard_skills_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('hard_skills/edit.html.twig', [
            'hard_skill' => $hardSkill,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_hard_skills_delete', methods: ['POST'])]
    public function delete(Request $request, HardSkills $hardSkill, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$hardSkill->getId(), $request->request->get('_token'))) {
            $entityManager->remove($hardSkill);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_hard_skills_index', [], Response::HTTP_SEE_OTHER);
    }
}
