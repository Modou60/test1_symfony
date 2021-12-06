<?php

namespace App\DataFixtures;

use Faker;


use App\Entity\User;
//  use Faker\Provider\DateTime;
use Doctrine\DBAL\Types\DateTimeType;
use Doctrine\Persistence\ObjectManager;
use Egulias\EmailValidator\Parser\Comment;
use Doctrine\Bundle\FixturesBundle\Fixture;

class Userfixtures extends Fixture
{

    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');
        for ($i = 1; $i <= 10; $i++) {
            $user = new User();
            $user->setUsername($faker->firstName())
            ->setPassword($faker->password())
            // ->setRoles()
                ->setNom($faker->lastName())
                ->setPrenom($faker->firstName())
                ->setDateNaissance($faker->dateTime())
                ->setAdresse($faker->address())
                ->setEmail($faker->email())
                ->setPhoto(" photo N° $i ");
                

            
        

         $manager->persist($user);

        $manager->flush();
    }
}
}