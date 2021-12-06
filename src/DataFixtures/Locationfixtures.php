<?php

namespace App\DataFixtures;

use App\Entity\Location;
use DateTime;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
// use phpDocumentor\Reflection\Location;
use Faker;

class Locationfixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = faker\Factory::create('fr_fr');
        for ($i = 0; $i <= 10; $i++) {
            $location = new Location;
$accessibility = ["Validée", "En attente", "Anulée"];
shuffle($accessibility);
            $location->setDate(new \DateTime())
                ->setTitre($faker->title())
                ->setCategorie($faker->company())
                ->setDescription($faker->sentence())                
                ->setValeur(mt_rand(0,1000))                
                ->setAdresse($faker->address())
                ->setAccessibility($accessibility[0])                
                ->setAlaune($faker->boolean(50))                
                ->setImage(" image de la location n° $i ");

        }


         $manager->persist($location);

        $manager->flush();
    }
}
