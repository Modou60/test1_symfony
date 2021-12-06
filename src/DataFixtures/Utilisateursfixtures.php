<?php

namespace App\DataFixtures;

use App\Entity\Utilisateurs;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Egulias\EmailValidator\Parser\Comment;
use Faker;
use Doctrine\DBAL\Types\DateTimeType;

class Utilisateursfixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');
        for ($i = 1; $i < 50; $i++) {
            $utilisateurs = new Utilisateurs();
            $rol = ["gestionnaire", "locataire", "propriétaire", "administrateur"];
            shuffle($rol);
            $utilisateurs->setNom($faker->lastName)
                ->setPrenom($faker->firstName())
                ->setDateNaissance(new DateTime())
                ->setAdresse($faker->address())
                ->setEmail($faker->email())
                ->setPhoto(" photo N° $i ");
            $manager->persist($utilisateurs);
            $manager->flush();
        }
    }
}
