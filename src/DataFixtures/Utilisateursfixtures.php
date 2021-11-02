<?php

namespace App\DataFixtures;

use App\Entity\Utilisateurs;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class Utilisateursfixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 50; $i++) {
            $utilisateurs = new Utilisateurs();
            $rol = ["gestionnaire", "locataire", "propriétaire", "administrateur"];
            shuffle($rol);
            $utilisateurs->setNom(" Nom N°$i ")
                ->setPrenom(" Prénom N° $i ")
                ->setDateNaissance(new DateTime())
                ->setLogin(" Login N° $i ")
                ->setPassWord(" Password N° $i ")
                ->setAdresse(" adresse N° $i ")
                ->setEmail(" Email N° $i ")
                ->setPhoto(" photo N° $i ")
                ->setRole($rol[0]);

            $manager->persist($utilisateurs);
            $manager->flush();
        }
    }
}
