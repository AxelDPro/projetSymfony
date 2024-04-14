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
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(ContactRepository $contactRepository, Request $request, EntityManagerInterface $manager,MailerInterface $mailer): Response
    {
        $contact = new Contact();
        $form=$this->createForm(ContactType::class,$contact);
        $form->handleRequest($request);

        

        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($contact);
            $manager->flush();

            $email = (new Email())
            ->from($contact->getMail())
            ->to('admin@gmail.fr')
            ->subject($contact->getObjet())
            ->text($contact->getMessage());
            
            $this->addFlash('success', 'Le formulaire a été soumis avec succès !');
            
            $mailer->send($email);

            return $this->redirectToRoute("app_contact");
        }

        return $this->render('contact/index.html.twig', [
            'contact'=>$contact,
            'form'=>$form->createView(),
        ]);
    }
}
