<?php

namespace App\Controller;

use App\Entity\Project;
use App\Entity\Person;
use App\Form\ProfileType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\SecurityBundle\Attribute\IsGranted;
use App\Entity\Participation;

#[IsGranted('ROLE_USER')]
#[Route('/profile')]
class ProfileController extends AbstractController
{
    #[Route('/', name: 'app_profile', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();

        // Récupérer les dons de l'utilisateur connecté
        $donations = $entityManager->getRepository(Participation::class)->findBy(
            ['donator' => $user],
            ['participantDate' => 'DESC'] // Trier du plus récent au plus ancien
        );
        $projects = $entityManager->getRepository(Project::class)->findBy(
            ['creator' => $user],
            ['openingDate' => 'DESC']
        );

        return $this->render('profile/index.html.twig', [
            'user' => $user,
            'donations' => $donations,
            'projects' => $projects,
        ]);
    }

    #[Route('/edit', name: 'app_profile_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();

        $form = $this->createForm(ProfileType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            $this->addFlash('success', 'Profil mis à jour avec succès.');

            return $this->redirectToRoute('app_profile');
        }
        $projects = $entityManager->getRepository(Project::class)->findBy(
            ['creator' => $user],
            ['openingDate' => 'DESC']
        );

        return $this->render('profile/edit.html.twig', [
            'form' => $form->createView(),
             'projects' => $projects,
        ]);
    }
}
