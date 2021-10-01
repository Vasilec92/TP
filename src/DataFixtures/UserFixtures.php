<?php

namespace App\DataFixtures;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture implements OrderedFixtureInterface
{

    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {         
        $this->passwordHasher = $passwordHasher;
    }
    public function load(ObjectManager $manager): void
    {
         $user = new User();
         $user->setEmail("anna@anna.ru");
         $user->setPassword($this->passwordHasher->hashPassword(
            $user,
            '123'
        ));
        $manager->persist($user);

        $manager->flush();
    }

     public function getOrder(){
        return 6;
    }
}
