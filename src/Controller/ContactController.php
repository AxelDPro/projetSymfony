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

        $message = ''; // Initialiser la variable message

        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($contact);
            $manager->flush();

            // Envoyer un email
            $email = (new Email())
            ->from('hello@example.com')
            ->to('you@example.com')
            ->subject('Nouveau contact enregistré')
            ->text('Un nouveau contact a été enregistré.');

            $mailer->send($email);

            // Définir le message de confirmation
            $message = 'Le contact a été enregistré avec succès !';

            return $this->redirectToRoute("app_contact");
        }

        return $this->render('contact/index.html.twig', [
            'contact'=>$contact,
            'form'=>$form->createView(),
            'message' => $message // Passer le message à la vue
        ]);
    }
}
