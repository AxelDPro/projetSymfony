<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\BiensRepository;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Biens;
use Symfony\Component\HttpFoundation\Request;
use Twig\Environment;
use App\Form\BiensType;


class BienController extends AbstractController {
    #[Route('/biens', name: 'app_biens')]
    public function biens(BiensRepository $biensRepository): Response {
        $biens = $biensRepository->findAll();
        return $this->render('biens/biens.html.twig', [
            'biens'=>$biens
        ]);
    }
    public function create(Request $request){
    $bien = new Biens();
    $form = $this->createForm(BiensType::class, $bien);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
     

    return $this->render('votre_template.html.twig', [
        'form' => $form->createView(),
    ]);
}
}
}

?>