<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\BiensRepository;
use App\Entity\Biens;
use App\Form\BiensType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;



class MembresController extends AbstractController
{
    #[Route('/membres', name: 'app_membresBiens')]
    public function membresBiens(BiensRepository $biensRepository): Response
    {
        $biens = $biensRepository->findAll();
        return $this->render('membres/membresBiens.html.twig', [
            'biens' => $biens,
        ]);
    }



    #[Route('/membres/{id}', name: 'membres_biens_modification')]
    public function modificationProduit(Biens $biens, BiensRepository $biensRepository, Request $request, EntityManagerInterface $manager): Response {

        $form=$this->createForm(BiensType::class ,$biens);
        $form->handleRequest($request);        

        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($biens);
            $manager->flush();
            return $this->redirectToRoute("app_membresBiens");
        }
 
        return $this->render('membres/modificationBiens.html.twig', [ 
            'biens'=> $biens,
            'form' => $form->createView()
        ]);
    }



    #[Route('/ajoutBiens', name: 'membres_biens_ajouter')]
    public function ajouterBiens(Request $request, EntityManagerInterface $manager): Response {
        $biens = new Biens;

        $form = $this->createForm(BiensType::class, $biens);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($biens);
            $manager->flush();
            
            return $this->redirectToRoute('app_membresBiens');
        }
        return $this->render('membres/ajouterBiens.html.twig', [ 
            'biens'=> $biens,
            'form' => $form->createView()
        ]);
    }


    #[Route('/membresDelete/{id}', name: 'membres_biens_delete')]
    public function deleteBiens(Biens $biens, BiensRepository $biensRepository, Request $request, EntityManagerInterface $manager): Response {
        $manager->remove($biens);
        $manager->flush();
        $this->addFlash('success','Suppression correctement effectuée !');
        return $this->redirectToRoute("app_membresBiens");
    }



}
