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
            $users[$i]->setEmail($faker->unique()->email);
            // $users[$i]->setRoles($faker->roles);
            $users[$i]->setPassword($faker->password);
            $users[$i]->setFirstname($faker->firstname);
            $users[$i]->setLastname($faker->lastname);
            $users[$i]->setPersonnalPicture("uploads/150(".rand(1, 8).")");
            // setImage(/uploads);
            //or
            // https://i.pravatar.cc/
            $users[$i]->setDepartement($faker->departement); //ne marche pas snif snif "mauvais format"
            $users[$i]->setContractType($faker->contract_type); //ne marche pas snif snif "mauvais format"
            $users[$i]->setContractEnd($faker->dateTimeBetween('-1 month', '+5 years'));



            $manager->persist($users[$i]);
        }
        $manager->flush();
    }
}
