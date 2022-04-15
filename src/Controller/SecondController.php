<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/second')]
class SecondController extends AbstractController
{
    #[Route(
        '/{name}/{age<[01]?\d{1,2}>}',
        name: 'app_second',
//        requirements: ['age' => '[01]?\d{1,2}']
//        defaults: ['name' => 'aymen']
    )]
    public function index($name, $age, Request $request): Response
    {
        if ($age % 3 ===0) {
            $this->addFlash('success', 'cc success');
        }
        if ($age % 2 ===0) {
            $this->addFlash('info', 'cc info');
        }
        dump($request);
        return $this->render('second/index.html.twig', [
            'controller_name' => 'SecondController',
            'esm' => $name,
            'age' => $age
        ]);
    }
}
