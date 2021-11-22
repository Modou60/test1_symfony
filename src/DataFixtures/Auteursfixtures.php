<?php

namespace App\DataFixtures;

use App\Entity\Auteurs;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class Auteursfixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i=0; $i<10; $i++)
        {
            $auteurs = new Auteurs;
            $auteurs->setNom("nom de l'auteur numéro $i")
            ->setPrenom("Prénom de l'auteur numéro $i")
            ->setEmail("le mail de l'auteur numéro $i");
        }
        $manager->persist($auteurs);
        $manager->flush();
        


    }
}
