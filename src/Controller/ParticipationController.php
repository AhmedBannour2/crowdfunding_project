<?php

namespace App\Controller;

use App\Entity\Project;
use App\Entity\Participation;
use App\Form\ParticipationType;
use App\Repository\ParticipationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/participation')]
final class ParticipationController extends AbstractController
{
    #[Route(name: 'app_participation_index', methods: ['GET'])]
    public function index(ParticipationRepository $participationRepository): Response
    {
        return $this->render('participation/index.html.twig', [
            'participations' => $participationRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_participation_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $participation = new Participation();
        

        $form = $this->createForm(ParticipationType::class, $participation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($participation);
            $entityManager->flush();

            return $this->redirectToRoute('app_participation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('participation/new.html.twig', [
            'participation' => $participation,
            'form' => $form,
           
        ]);
    }

    #[Route('/{id}', name: 'app_participation_show', methods: ['GET', 'POST'])]
public function show(int $id, Request $request, EntityManagerInterface $entityManager): Response
{
    // Vérifier si l'utilisateur est connecté
    if (!$this->getUser()) {
        $this->addFlash('danger', 'Vous devez être connecté pour voir cette participation.');
        return $this->redirectToRoute('app_login');
    }

    // Récupérer la participation
    $participation = $entityManager->getRepository(Participation::class)->find($id);
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
    if (!$participation) {
        throw $this->createNotFoundException('La participation demandée n\'existe pas.');
    }

    // Récupérer le projet lié à la participation
    $project = $participation->getProject();

    if (!$project) {
        throw $this->createNotFoundException('Le projet associé à cette participation est introuvable.');
    }

    // Récupérer les autres donations associées au projet
    $donations = $entityManager->getRepository(Participation::class)->findBy(
        ['project' => $project],
        ['participantDate' => 'DESC']
    );

    return $this->render('project/show.html.twig', [
        'participation' => $participation,
        'project' => $project,
        'donations' => $donations,
        'form' => $form->createView(),
    ]);
}


    #[Route('/{id}/edit', name: 'app_participation_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Participation $participation, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ParticipationType::class, $participation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_participation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('participation/edit.html.twig', [
            'participation' => $participation,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_participation_delete', methods: ['POST'])]
    public function delete(Request $request, Participation $participation, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$participation->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($participation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_participation_index', [], Response::HTTP_SEE_OTHER);
    }

    
}
