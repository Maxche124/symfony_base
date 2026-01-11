<?php

namespace App\Controller;

use App\Entity\PokeBall;
use App\Form\PokeBallType;
use App\Repository\PokeBallRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/admin/pokeball')]
#[IsGranted('ROLE_ADMIN')]
class AdminPokeBallController extends AbstractController
{
    #[Route('/new', name: 'admin_pokeball_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $pokeBall = new PokeBall();
        $form = $this->createForm(PokeBallType::class, $pokeBall);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($pokeBall);
            $entityManager->flush();

            $this->addFlash('success', 'PokeBall created successfully!');

            return $this->redirectToRoute('app_poke_ball_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/pokeball/new.html.twig', [
            'poke_ball' => $pokeBall,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'admin_pokeball_show', methods: ['GET'])]
    public function show(PokeBall $pokeBall): Response
    {
        return $this->render('admin/pokeball/show.html.twig', [
            'poke_ball' => $pokeBall,
        ]);
    }

    #[Route('/{id}/edit', name: 'admin_pokeball_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, PokeBall $pokeBall, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PokeBallType::class, $pokeBall);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash('success', 'PokeBall updated successfully!');

            return $this->redirectToRoute('app_poke_ball_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/pokeball/edit.html.twig', [
            'poke_ball' => $pokeBall,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'admin_pokeball_delete', methods: ['POST'])]
    public function delete(Request $request, PokeBall $pokeBall, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$pokeBall->getId(), $request->request->get('_token'))) {
            if ($pokeBall->getOrderItems()->isEmpty()) {
                $entityManager->remove($pokeBall);
                $entityManager->flush();
                $this->addFlash('success', 'PokeBall deleted successfully!');
            } else {
                $this->addFlash('error', 'Cannot delete this PokeBall as it is part of an order.');
            }
        }

        return $this->redirectToRoute('app_poke_ball_index', [], Response::HTTP_SEE_OTHER);
    }
}
