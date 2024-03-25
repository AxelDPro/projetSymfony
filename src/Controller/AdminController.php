<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\BiensRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\BiensType;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Biens;



class AdminController extends AbstractController
{
    #[Route('/admin', name: 'app_admin')]
    public function adminBiens(BiensRepository $biensRepository): Response {
        $biens = $biensRepository->findAll();
        return $this->render('admin/adminBiens.html.twig', [
            'biens' => $biens
        ]);
    }



    #[Route('/admin/{id}', name: 'admin_biens_modification')]
    public function modificationProduit(Biens $biens, BiensRepository $biensRepository, Request $request, EntityManagerInterface $manager): Response {

        $form=$this->createForm(BiensType::class ,$biens);
        $form->handleRequest($request);        

        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($biens);
            $manager->flush();
            return $this->redirectToRoute("app_adminBiens");
        }
 
        return $this->render('admin/modificationBiens.html.twig', [ 
            'biens'=> $biens,
            'form' => $form->createView()
        ]);
    }


    #[Route('/ajoutProduit', name: 'admin_produit_ajouter')]
    public function ajouterProduit(Request $request, EntityManagerInterface $manager): Response {
        $produit = new Biens;

        $form = $this->createForm(BiensType::class, $produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($produit);
            $manager->flush();
            
            return $this->redirectToRoute('app_adminProduits');
        }
        return $this->render('admin/ajouterProduit.html.twig', [ 
            'produit'=> $produit,
            'form' => $form->createView()
        ]);
    }
}
