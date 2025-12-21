<?php

namespace App\Controller;

use App\Repository\PokeBallRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PokeBallController extends AbstractController
{
    #[Route('/', name: 'app_pokeball_index')]
    public function index(PokeBallRepository $pokeBallRepository): Response
    {
        $pokeBalls = $pokeBallRepository->findAll();

        return $this->render('pokeball/index.html.twig', [
            'pokeBalls' => $pokeBalls,
        ]);
    }
}
