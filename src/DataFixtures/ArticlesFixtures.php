<?php

namespace App\DataFixtures;

// use Faker\Factory;
use App\Entity\Auteurs;
use App\Entity\Articles;
use App\Entity\Categorie;
use App\Entity\Commentaires;
use Doctrine\DBAL\Types\DateTimeType;
use Doctrine\Persistence\ObjectManager;
use Egulias\EmailValidator\Parser\Comment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\DBAL\Driver\IBMDB2\Exception\Factory;
use Symfony\Component\Validator\Constraints\DateTime;
 use Faker;

class ArticlesFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
         $faker = Faker\Factory::create('fr_FR');

        // je remplis mes auteurs
        for ($i = 1; $i <= 50; $i++) {

            $auteurs = new Auteurs();
            $auteurs->setNom($faker->lastName)
                ->setPrenom($faker->firstName())
                ->setEmail($faker->email);

            $manager->persist($auteurs);

            // Création des categories
            
            $categorie = new Categorie();
            $categorie->setTitre($faker->title())
                ->setResume($faker->sentence());

            $manager->persist($categorie);

            // Creation des article pour chaque categorie 
            for ($j = 1; $j <= 10; $j++) {
                $articles = new Articles();
                $articles->setTitre($faker->title())
                    ->setResume($faker->sentence())
                    ->setContenu($faker->sentence())
                    ->setImage($faker->sentence())
                    ->setDate($faker->dateTime())
                    ->setCategorie($categorie)
                    ->setAuteur($auteurs);

                $manager->persist($articles);

                // Creation des commentaires pour chaque article 

                for ($m = 1; $m <= 10; $m++) {
                    $com = new Commentaires();

                    $com->setAuteur("Auteur du commentaire $m pour l'article $j")
                    ->setMail($faker->email())
                        ->setDate($faker->dateTime())
                        ->setContenu($faker->sentence())
                        ->setArticle($articles)
                        ;
                }
            }
        }
        $manager->flush();
    }
}
