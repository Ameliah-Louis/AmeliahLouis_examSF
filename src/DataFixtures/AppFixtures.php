<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
// use Symfony\Component\Security\Core\User\PasswordHasherInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Doctrine\Persistence\ObjectManager;
use Faker;

class AppFixtures extends Fixture
{
    const DEPARTMENT = [
        'RH',
        'Informatique',
        'Direction',
        'Comptabilité',
    ];
    const CONTRACT_TYPE = [
        'CDI',
        'CDD',
        'Intérim',
    ];

    public function load(ObjectManager $manager): void
    {
        // squelette basique
        // $user = new User();
        // $manager->persist($user);
        // $manager->flush();
        
        //mauvaise façon de faire, j'ai tout repris par la suite.
        //         $users = Array();
        //         for ($i = 0; $i < SELF::NB_USER; $i++) {
        //             $users[$i] = new User();
        //             $users[$i]->setEmail($faker->unique()->email);
        //             // $users[$i]->setRoles($faker->roles);
        //             $users[$i]->setPassword($faker->password);
        //             $users[$i]->setFirstname($faker->unique()->firstname);
        //             $users[$i]->setLastname($faker->unique()->lastname);
        //             $users[$i]->setPersonnalPicture("uploads/150(".rand(1, 8).")");
        //             // setImage(/uploads);
        //             //or
        //             // https://i.pravatar.cc/
        //             $users[$i]->setDepartement($faker->randomElement(self::DEPARTMENT)); //ne marche pas snif snif "mauvais format"
        // //             const NBFF : ['rh, gdg,'];
        // //              setSector($faker->randomElement(self:NBFF));
        //             $users[$i]->setContractType($this->$faker->randomElement(self::CONTRACT_TYPE)); //ne marche pas snif snif "mauvais format"
        //             $users[$i]->setContractEnd($faker->dateTimeBetween('-1 month', '+5 years'));
        //             $manager->persist($users[$i]);
        //         }
        // on crée 4 Users avec des données "aléatoires" en français
        $faker = Faker\Factory::create('fr_FR');

        $users = [];
                
                
                $user = new User();
            
                            $user //le user spécial pour la correction
                                ->setEmail('rh@hb.com')
                                ->setFirstname('toto')
                                ->setLastname('TUMESOUL')
                                ->setRoles(["ROLE_ADMIN"])
                                ->setContractEnd($faker->unique()->dateTimeBetween('-1 month', '+5 years'))
                                ->setContractType($faker->randomElement(self::CONTRACT_TYPE))
                                ->setDepartement($faker->randomElement(self::DEPARTMENT))
                                ->setPersonnalPicture('https://icons.veryicon.com/png/o/system/ali-mom-icon-library/random-user.png')
                                //Ne marche pas, j'ai tenté ^^'
                                ->setPersonnalPicture("uploads/150(".rand(1, 8).")")
                                // ->setPassword(hashPassword('azerty123'));
                                ->setPassword(password_hash('azerty123', PASSWORD_BCRYPT));
                            $manager->persist($user);
                $manager->flush();

                
                // // j'ai give up sur la façon de faire ci dessous.
                //
                // $plaintextPassword = 'user';
                // for ($i = 0; $i < 20; $i++) 
                // {
                //     $user = new User();
                    
                //     //bloque pour le reste à cause du hasher donc mise en commentaire pour pouvoir add le user de correction.
                //     //création des users randomisés
                //     $user 
                //         ->setEmail($faker->unique()->email())
                //         ->setFirstname($faker->unique()->firstName())
                //         ->setLastname($faker->unique()->lastName())
                //         ->setRoles(["ROLE_USER"]) //car ce ne sont que des employés qui sont crées.
                //         ->setContractEnd($faker->unique()->dateTimeBetween('-1 month', '+5 years'))
                //         ->setContractType($faker->randomElement(self::CONTRACT_TYPE))
                //         ->setDepartement($faker->randomElement(self::DEPARTMENT))
                //         ->setPersonnalPicture("uploads/150(".rand(1, 8).")")
                        
                //         // ->setPassword(hashPassword('azerty123'));
                //         ->setPassword(password_hash('azerty123', PASSWORD_BCRYPT));
                //     // $hashedPassword = $this->userPasswordHasher->hashPassword(
                //     //     $user,
                //     //     $plaintextPassword
                //     // );
                //     // $user->setPassword($hashedPassword);
                //         $manager->persist($user);
                }
    }
