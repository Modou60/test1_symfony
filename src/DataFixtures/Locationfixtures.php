<?php

namespace App\DataFixtures;

use App\Entity\Location;
use DateTime;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
// use phpDocumentor\Reflection\Location;

class Locationfixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i <= 40; $i++) {
            $location = new Location;
$accessibility = ["Validée", "En attente", "Anulée"];
shuffle($accessibility);
            $location->setDate("date \DateTime")
                ->setTitre(" Titre de la location n° $i")
                ->setCategorie(" Catégorie de la location n° $i ")
                ->setDescription(" Description de la location n° $i ")                
                ->setValeur(" Valeur de la location n° $i ")                
                ->setAdresse(" l'adresse de la location n° $i ")                
                ->setAccessibility($accessibility[0])                
                ->setAlaune(" La une de la location n° $i")                
                ->setImage(" image de la location n° $i ");

        }


        // $manager->persist($product);

        $manager->flush();
    }
}
