<?php

namespace App\Controller;

use App\Entity\Project;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'home')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        // Récupérer les 10 derniers projets créés
        $recentProjects = $entityManager->getRepository(Project::class)->findBy([], ['id' => 'DESC'], 10);

        // Récupérer les 10 projets les plus populaires (ceux avec le plus de participations)
        $query = $entityManager->createQuery(
            'SELECT p FROM App\Entity\Project p 
             JOIN p.participations par 
             GROUP BY p 
             ORDER BY COUNT(par) DESC'
        )->setMaxResults(10);
        
        $popularProjects = $query->getResult();

        return $this->render('home/index.html.twig', [
            'recentProjects' => $recentProjects,
            'popularProjects' => $popularProjects,
        ]);
    }
}
