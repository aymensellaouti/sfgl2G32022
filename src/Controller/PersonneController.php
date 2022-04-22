<?php

namespace App\Controller;

use App\Entity\Personne;
use App\Repository\PersonneRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/personne')]
class PersonneController extends AbstractController
{
//    private $repository;
    private $manager;
    public function __construct(private ManagerRegistry $doctrine, private PersonneRepository $repository)
    {
//        $this->repository = $doctrine->getRepository(Personne::class);
        $this->manager = $doctrine->getManager();
    }

    #[Route('/', name: 'app_personne')]
    public function index(): Response
    {
        $personnes = $this->repository->findAll();
        return $this->render('personne/index.html.twig', [
            'personnes' => $personnes,
        ]);
    }
    #[Route('/delete/{id}', name: 'app_personne_delete')]
    public function deletePersonne(Personne $personne = null): Response
    {
        if (!$personne) {
            throw new NotFoundHttpException("Page Not Found !!");
        } else {
            $this->manager->remove($personne);
            $this->manager->flush();
            $this->addFlash('success', "Personne supprimée avec succès");
            return $this->forward("App\\Controller\\PersonneController::index");
        }
    }
}
