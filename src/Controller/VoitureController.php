<?php

namespace App\Controller;

use App\Entity\Voiture;
use App\Form\VoitureType;
use App\Repository\PersonneRepository;
use App\Repository\VoitureRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
#[Route('/voiture')]
class VoitureController extends AbstractController
{
    private $manager;
    public function __construct(private ManagerRegistry $doctrine, private VoitureRepository $repository)
    {
//        $this->repository = $doctrine->getRepository(Personne::class);
        $this->manager = $doctrine->getManager();
    }
    #[Route('/', name: 'app_voiture')]
    public function index(): Response
    {
        $voitures = $this->repository->findAll();
        return $this->render('voiture/index.html.twig', [
            'voitures' => $voitures,
        ]);
    }
    #[Route('/edit/{id?0}', name: 'app_voiture_edit')]
    public function edit(Request $request, Voiture $voiture = null): Response
    {
        if (!$voiture) {
            $voiture = new Voiture();
        }
        // Je dois récupérer le formulaire
        $form = $this->createForm(VoitureType::class, $voiture);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
           $this->manager->persist($voiture);
           $this->manager->flush();
           return $this->redirectToRoute('app_voiture');
        }
        return $this->render('voiture/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

}
