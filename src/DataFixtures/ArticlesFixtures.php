<?php
namespace App\DataFixtures;
use App\Entity\Articles;
use App\Entity\Categorie;
use App\Entity\Auteurs;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use DateTime;
use Doctrine\DBAL\Types\DateTimeType;
// use Faker;

class ArticlesFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $faker = faker\Factory::create('fr_Fr');

// je remplis mes auteurs
        for ($i=0; $i<3; $i++)
        {
            $auteurs = new Auteurs;
            $auteurs->setNom("nom de l'auteur numéro $i")
            ->setPrenom("Prénom de l'auteur numéro $i")
            ->setEmail("le mail de l'auteur numéro $i");
        
        $manager->persist($auteurs);
        $manager->flush();

        // je crée 5 catégories et 10 articles
        for ($k = 0; $k < 4; $k++) {
            // j'instancie la classe catégorie
            $categorie = new Categorie();

            // je remplis ses champs
            $categorie->setTitre("Titre de la catégorie numéro $k")
                ->setResume("Résumé de ma catégorie");

            // je persiste la catégorie
            $manager->persist($categorie);

            // je crée mes articles
            for ($j = 0; $j < 4; $j++) {
                // j'instancie la classe article
                $articles = new Articles();
                
                // je remplis
                $articles->setTitre("Titre de l'article numéro $j")
                     ->setImage("la photo de mon image pour l'article numéro $j")
                    ->setResume("Résumé de l'article numéro $j")
                    ->setContenu("Contenu de l'article numéro $j")
                    ->setDate(new \DateTime())
                    // ajout de la catégorie
                    ->setCategorie($categorie)
                    // ajout de l'auteur
                    ->setAuteur($auteurs)
                    ;

                // je persiste mon article
                $manager->persist($articles);
            }
            $manager->flush();
            
        }

        // je flush mes données
        $manager->flush();
    }
} 

}