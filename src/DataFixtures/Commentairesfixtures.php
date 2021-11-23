<?php

namespace App\DataFixtures;

use App\Entity\Commentaire;
use App\Entity\Utilisateurs;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use Symfony\Component\Validator\Constraints\Date;

class Commentairesfixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i=0; $i<5; $i++)
        {
            $commentaire = new Commentaire;
            
            $commentaire->setAuteur("l'auteur du commentaire")
            ->setEmail("Mail de l'auteur numéro $i")
            ->setDate(new DateTime())
            ->setCommentaire("Le commentaire du numéro $i");
        }
        $manager->persist($commentaire);
        $manager->flush();
    }
}
