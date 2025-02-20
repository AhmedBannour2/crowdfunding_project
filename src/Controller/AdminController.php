<?php

namespace App\Controller;

use App\Entity\Person;
use App\Entity\Project;
use App\Entity\Participation;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\SecurityBundle\Attribute\IsGranted;

#[IsGranted('ROLE_ADMIN')] // Seuls les admins peuvent accéder à ce contrôleur
#[Route('/admin')]
class AdminController extends AbstractController
{
    #[Route('/dashboard', name: 'admin_dashboard')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        // Récupérer la liste des utilisateurs
        $users = $entityManager->getRepository(Person::class)->findAll();
        $nbUsers = $entityManager->getRepository(Person::class)->count([]);
        $nbProjects = $entityManager->getRepository(Project::class)->count([]);
        $nbDonations = $entityManager->getRepository(Participation::class)->count([]);
        $totalDonationAmount = $entityManager->createQuery('SELECT SUM(p.amount) FROM App\Entity\Participation p')->getSingleScalarResult();

        return $this->render('admin/dashboard.html.twig', [
            'users' => $users,
            'nbUsers' => $nbUsers,
            'nbProjects' => $nbProjects,
            'nbDonations' => $nbDonations,
            'totalDonationAmount' => $totalDonationAmount ?? 0, // Empêcher une erreur si NULL
        ]);
    }
}
