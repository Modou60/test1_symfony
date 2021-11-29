<?php

namespace App\DataFixtures;

use App\Entity\Auteurs;
use App\Entity\Articles;
use App\Entity\Categorie;
use App\Entity\Commentaire;
use App\Entity\Commentaires;
use Doctrine\DBAL\Types\DateTimeType;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Egulias\EmailValidator\Parser\Comment;
use Symfony\Component\Validator\Constraints\DateTime;
// use Faker;

class ArticlesFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $faker = faker\Factory::create('fr_Fr');

        // je remplis mes auteurs
        for ($i = 1; $i <= 5; $i++) {

            $auteurs = new Auteurs();
            $auteurs->setNom("nom de l'auteur numéro $i")
                ->setPrenom("Prénom de l'auteur numéro $i")
                ->setEmail("le mail de l'auteur numéro $i");

            $manager->persist($auteurs);

            // Création des categories
            $categorie = new Categorie();
            $categorie->setTitre("Titre Categorie $i")
                ->setResume("Resume de categorie $i");

            $manager->persist($categorie);

            // Creation des article pour chaque categorie 
            for ($j = 1; $j <= 3; $j++) {
                $articles = new Articles();
                $articles->setTitre("Titre Article $j")
                    ->setResume("Resume de l'article $j")
                    ->setContenu("Contenu de l'article $j")
                    ->setImage("image.jpg")
                    ->setDate(new \DateTime())
                    ->setCategorie($categorie)
                    ->setAuteur($auteurs);

                $manager->persist($articles);

                // Creation des commentaires pour chaque article 

                for ($m = 1; $m <= 3; $m++) {
                    $com = new Commentaires();

                    $com->setAuteur("Auteur du commentaire $m pour l'article $j")
                        ->setMail("modou@free.fr")
                        ->setDate(new \DateTime())
                        ->setContenu("Contenue du commentaire")
                        ->setArticle($articles)
                        ;
                }
            }
        }
        $manager->flush();
    }
}
