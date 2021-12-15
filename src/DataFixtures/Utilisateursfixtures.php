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
        for ($i = 1; $i < 20; $i++) {
            $utilisateurs = new Utilisateurs();
            $role = ["Admin", "User", "Editeur"];
            shuffle($role);
            $civilite = ["madame", "monsieur"];
            shuffle($civilite);
            $utilisateurs->setCivilite($civilite[0])
                ->setNom($faker->lastName)
                ->setPrenom($faker->firstName())
                ->setDateNaissance(new DateTime())
                ->setAdresse($faker->address())
                ->setEmail($faker->email())
                ->setPhoto(" photo N° $i ")
                ->setUsername($faker->userName)
                ->setPassword($faker->password())
                ->setRoles($role[0]);

            $manager->persist($utilisateurs);
            $manager->flush();
        }
    }
}
