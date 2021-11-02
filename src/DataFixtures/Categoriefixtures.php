<?php

namespace App\DataFixtures;

use App\Entity\Categorie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
// use Faker;
class Categoriefixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        for ($i=0; $i<20 ; $i++ ) 
        {
            $categorie = new Categorie();
            $categorie->setTitre(" titre N°$i ")
            ->setResume(" Résumé N° $i ");
            
            $manager->persist($categorie);
            $manager->flush();
        
    }
}
}