<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{

    public function __construct(private readonly UserPasswordHasherInterface $hasher)
    {

    }
    public function load(ObjectManager $manager): void
    {   $user = new User();
        $user->setEmail('john@doe.fr');
        $user->setPassword($this->hasher->hashPassword($user, '123456'));
        $user->setName('Doe');
        $user->setFirstName('John');
        $user->setPhoneNumber('0606060606');
        $user->setCampus($this->getReference('campus_nantes'));
        $user->setIsVerified(true);
        $manager->persist($user);


        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
