<?php

namespace App\Controller;

use App\Entity\Biens;
use App\Form\Biens1Type;
use App\Repository\BiensRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/test/biens')]
class TestBiensController extends AbstractController
{
    #[Route('/', name: 'app_test_biens_index', methods: ['GET'])]
    public function index(BiensRepository $biensRepository): Response
    {
        return $this->render('test_biens/index.html.twig', [
            'biens' => $biensRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_test_biens_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $bien = new Biens();
        $form = $this->createForm(Biens1Type::class, $bien);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($bien);
            $entityManager->flush();

            return $this->redirectToRoute('app_test_biens_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('test_biens/new.html.twig', [
            'bien' => $bien,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_test_biens_show', methods: ['GET'])]
    public function show(Biens $bien): Response
    {
        return $this->render('test_biens/show.html.twig', [
            'bien' => $bien,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_test_biens_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Biens $bien, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(Biens1Type::class, $bien);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_test_biens_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('test_biens/edit.html.twig', [
            'bien' => $bien,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_test_biens_delete', methods: ['POST'])]
    public function delete(Request $request, Biens $bien, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$bien->getId(), $request->request->get('_token'))) {
            $entityManager->remove($bien);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_test_biens_index', [], Response::HTTP_SEE_OTHER);
    }
}
