<?php

namespace App\DataFixtures;

use App\Entity\Articles;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
// use Faker;

class Articlesfixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i=0; $i<50 ; $i++ ) 
        { 
            $articles = new Articles();
            
            $articles->setTitre(" Titre de l'article N°$i ")
                    ->setContenu(" Contenu de l'article N° $i ")
                    ->setDate(new \DateTime())
                    ->setResume(" Résumé de l'article N° $i ")
->setImage(" image de mon article N° $i ");
                    $manager->persist($articles);
        $manager->flush();
    }
}
}