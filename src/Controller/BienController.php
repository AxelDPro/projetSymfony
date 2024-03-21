<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\BiensRepository;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Biens;
use Twig\Environment;


class BienController extends AbstractController {
    #[Route('/biens', name: 'app_biens')]
    public function biens(BiensRepository $biensRepository): Response {
        $biens = $biensRepository->findAll();
        return $this->render('biens/biens.html.twig', [
            'biens'=>$biens
        ]);
    }
}

?>