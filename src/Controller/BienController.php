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
    public function create(Request $request)
{
    $bien = new Biens();
    $form = $this->createForm(BiensType::class, $bien);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        // 1. Récupérer le fichier téléchargé
        $imageFile = $form->get('imageFile')->getData();

        // Vérifier si un fichier a été téléchargé
        if ($imageFile) {
            // 2. Déplacer le fichier vers un emplacement permanent
            $newFilename = uniqid().'.'.$imageFile->guessExtension();

            // Déplacer le fichier vers le répertoire où sont stockées les images
            $imageFile->move(
                $this->getParameter('images_directory'), // Le répertoire de destination (défini dans le fichier de configuration)
                $newFilename
            );

            // 3. Enregistrer le chemin de ce fichier dans votre entité Biens
            $bien->setImage($newFilename); // Supposons que la méthode setImage() de votre entité Biens stocke le chemin du fichier

            // Nettoyage - Si nécessaire, vous pouvez supprimer le fichier temporaire stocké par Symfony après l'avoir déplacé
            // Cela dépend de votre cas d'utilisation

            // 4. Enregistrer l'entité dans votre base de données
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($bien);
            $entityManager->flush();

            // Redirection vers une autre page après la soumission réussie
            return $this->redirectToRoute('page_de_confirmation');
        }
    }

    return $this->render('votre_template.html.twig', [
        'form' => $form->createView(),
    ]);
}
}

?>