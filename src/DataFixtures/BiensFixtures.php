<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Biens;


class BiensFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $bien1 = new Biens();
        $bien1->setTitre("Maison Des Sept Cieux")
            ->setDescription("PentHouse avec Vue de MALADE")
            ->setSurface(300)
            ->setPrix(300000)
            ->setNbPieces(7)
            ->setNbChambre(3)
            ->setEtage(2)
            ->setVille("Marseille")
            ->setAdresse("1 Rue Salvador Allende")
            ->setType("PentHouse")
            ->setCp("33000")
            ->setImage("67ef9327029d540a008d7418d9b49bd8.jpg");


        $manager->persist($bien1);

        $manager->flush();





    }
}
