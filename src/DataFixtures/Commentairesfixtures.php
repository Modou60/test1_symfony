<?php

namespace App\DataFixtures;

use App\Entity\Commentaires;
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
            $commentaires = new Commentaires;
            
            $commentaires->setAuteur("l'auteur du commentaire")
            ->setMail("Mail de l'auteur numéro $i")
            ->setDate(new DateTime())
            ->setCommentaire("Le commentaire du numéro $i");
        }
        $manager->persist($commentaires);
        $manager->flush();
    }
}
