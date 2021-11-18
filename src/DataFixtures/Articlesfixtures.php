<?php

namespace App\DataFixtures;

use App\Entity\Articles;
use App\Entity\Categorie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
// use Faker;

class ArticlesFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $faker = faker\Factory::create('fr_Fr');

        // je crée 5 catégories et 10 articles
        for ($i = 0; $i < 5; $i++) {
            // j'instancie la classe catégorie
            $categorie = new Categorie();

            // je remplis ses champs
            $categorie->setTitre("Titre numéro $i")
                ->setResume("Résumé de la catégorienuméro $i");

            // je persiste la catégorie
            $manager->persist($categorie);

            // je crée mes articles
            for ($j = 0; $j < 10; $j++) {
                // j'instancie la classe article
                $articles = new Articles();

                // je fais un shuffle
                // shuffle($categorie);
                // je remplis
                $articles->setTitre("Titre de l'article numéro $j")
                     ->setImage("la photo de mon image pour l'article numéro $j")
                    ->setResume("Résumé de l'article numéro $j")
                    ->setContenu("Contenu de l'article numéro $j")
                    ->setDate(new \DateTime())
                    ->setCategorie($categorie);

                // je persiste mon article
                $manager->persist($articles);
            }
        }

        // je flush mes données
        $manager->flush();
    }
}
