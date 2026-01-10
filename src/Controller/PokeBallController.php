<?php

namespace App\Controller;

use App\Repository\PokeBallRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PokeBallController extends AbstractController
{
    #[Route('/', name: 'app_pokeball_index')]
    public function index(PokeBallRepository $pokeBallRepository, Request $request): Response
    {
        $pokeBalls = $pokeBallRepository->findAll();
        $locale = $request->getLocale();

        return $this->render('pokeball/index.html.twig', [
            'pokeBalls' => $pokeBalls,
            'locale' => $locale,
        ]);
    }
}
