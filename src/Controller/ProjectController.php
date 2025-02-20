<?php

namespace App\Controller;

use App\Form\ParticipationType; 
use App\Entity\Participation;
use App\Entity\Project;
use App\Form\ProjectType;
use App\Repository\ProjectRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\SecurityBundle\Attribute\IsGranted;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;


#[Route('/project')]
final class ProjectController extends AbstractController
{
    
    #[Route(name: 'app_project_index', methods: ['GET'])]
    public function index(ProjectRepository $projectRepository): Response
    {
        return $this->render('project/index.html.twig', [
            'projects' => $projectRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_project_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        $project = new Project();
        $project->setCreator($user); 
        $form = $this->createForm(ProjectType::class, $project);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($project);
            $entityManager->flush();

            return $this->redirectToRoute('app_project_index', [], Response::HTTP_SEE_OTHER);
        }
        
        if (!$this->isGranted('ROLE_USER')) {
            $this->addFlash('error', 'Vous devez être connecté pour accéder à cette page.');
            return $this->redirectToRoute('app_login');
        }
        
        return $this->render('project/new.html.twig', [
            'project' => $project,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'project_show', methods: ['GET', 'POST'])]
    public function show(Project $project, Request $request, EntityManagerInterface $entityManager): Response
    {
        if (!$this->getUser()) {
            $this->addFlash('danger', 'Vous devez être connecté pour faire un don.');
            return $this->redirectToRoute('app_login');
        }
        
        $participation = new Participation();
        $form = $this->createForm(ParticipationType::class, $participation);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            $participation->setProject($project);
            $participation->setDonator($this->getUser());
            $participation->setParticipantDate(new \DateTime());
    
            $entityManager->persist($participation);
            $entityManager->flush();
    
            $this->addFlash('success', 'Merci pour votre don !');
    
            return $this->redirectToRoute('project_show', ['id' => $project->getId()]);
        }
    
        $donations = $entityManager->getRepository(Participation::class)->findBy(
            ['project' => $project],
            ['participantDate' => 'DESC']
        );
    
        return $this->render('project/show.html.twig', [
            'project' => $project,
            'donations' => $donations,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}/edit', name: 'project_edit', methods: ['GET', 'POST'])]
public function edit(Project $project, Request $request, EntityManagerInterface $entityManager): Response
{
    // Vérifier si l'utilisateur connecté est le créateur du projet
    if ($project->getCreator() !== $this->getUser()) {
        throw $this->createAccessDeniedException("Vous ne pouvez modifier que vos propres projets.");
    }

    $form = $this->createForm(ProjectType::class, $project);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $entityManager->flush();
        $this->addFlash('success', 'Projet mis à jour avec succès.');
        return $this->redirectToRoute('app_project_index');
    }

    return $this->render('project/edit.html.twig', [
        'form' => $form->createView(),
        'project' => $project,
    ]);
}

#[Route('/{id}/delete', name: 'project_delete', methods: ['POST'])]
public function delete(Project $project, EntityManagerInterface $entityManager, Request $request): Response
{
    // Vérifier si l'utilisateur connecté est le créateur du projet
    if ($project->getCreator() !== $this->getUser()) {
        throw $this->createAccessDeniedException("Vous ne pouvez supprimer que vos propres projets.");
    }

    // Vérifier s'il y a des participations avant de supprimer
    if (!$project->getParticipations()->isEmpty()) {
        $this->addFlash('danger', 'Impossible de supprimer un projet qui a déjà reçu des dons.');
        return $this->redirectToRoute('app_project_index');
    }

    if ($this->isCsrfTokenValid('delete'.$project->getId(), $request->request->get('_token'))) {
        $entityManager->remove($project);
        $entityManager->flush();
        $this->addFlash('success', 'Projet supprimé avec succès.');
    }

    return $this->redirectToRoute('app_project_index');
}
}
