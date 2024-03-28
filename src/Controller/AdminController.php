<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\BiensRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Form\BiensType;
use App\Entity\Biens;
use Doctrine\DBAL\Platforms\MariaDb1060Platform;



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
            return $this->redirectToRoute("app_admin");
        }
 
        return $this->render('admin/modificationBiens.html.twig', [ 
            'biens'=> $biens,
            'form' => $form->createView()
        ]);
    }


    #[Route('/ajoutBiens', name: 'admin_biens_ajouter')]
    public function ajouterBiens(Request $request, EntityManagerInterface $manager): Response {
        $biens = new Biens;

        $form = $this->createForm(BiensType::class, $biens);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $type = $form->get('type')->getData();
            $biens->setType($type);
            $manager->persist($biens);
            $manager->flush();
            
            return $this->redirectToRoute('app_admin');
        }
        return $this->render('admin/ajouterBiens.html.twig', [ 
            'biens'=> $biens,
            'form' => $form->createView()
        ]);
    }



    #[Route('/adminDelete/{id}', name: 'admin_biens_delete')]
    public function deleteBiens(Biens $biens, BiensRepository $biensRepository, Request $request, EntityManagerInterface $manager): Response {
        $manager->remove($biens);
        $manager->flush();
        $this->addFlash('success','Suppression correctement effectuer !');
        return $this->redirectToRoute("app_admin");
    }
}
