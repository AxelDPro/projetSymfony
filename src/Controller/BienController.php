<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\BienRepository;

class BienController extends AbstractController
{
    #[Route('/biens', name: 'app_biens')]
    public function biens(BienRepository $biensRepository): Response
    {
        $biens = $biensRepository->findAll();
        return $this->render('biens/biens.html.twig', [
            'biens'=>$biens
        ]);
    }
}