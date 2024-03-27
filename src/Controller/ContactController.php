<?php

namespace App\Controller;

use App\Repository\ContactRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Form\ContactType;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Contact;
use Doctrine\ORM\EntityManagerInterface;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(ContactRepository $contactRepository, Request $request, EntityManagerInterface $manager): Response
    {
        $contact = new Contact();
        $form=$this->createForm(ContactType::class,$contact);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($contact);
            $manager->flush();
            return $this->redirectToRoute("app_contact");
        }
        return $this->render('contact/index.html.twig', [
            'contact'=>$contact,
            'form'=>$form->createView()
        ]);
    }
}
