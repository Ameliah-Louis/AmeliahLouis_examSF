<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $user = new User();
        // $manager->persist($user);

        // $manager->flush();
        $faker = Faker\Factory::create('fr_FR');
        // on crée 4 Users avec noms et prénoms "aléatoires" en français
        $users = Array();
        for ($i = 0; $i < 20; $i++) {
            $users[$i] = new User();
            $users[$i]->setEmail($faker->email);
            // $users[$i]->setRoles($faker->roles);
            $users[$i]->setPassword($faker->password);
            $users[$i]->setFirstname($faker->firstname);
            $users[$i]->setLastname($faker->lastname);
            $users[$i]->setPersonnalPicture($faker->personnal_picture);
            // $users[$i]->setDepartement($faker->departement);
            // $users[$i]->setContractType($faker->contract_type);
            // $users[$i]->setContractEnd($faker->contract_end);



            $manager->persist($users[$i]);
        }
        $manager->flush();
    }
}
