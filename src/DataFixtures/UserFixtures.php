<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture implements DependentFixtureInterface
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

        $user2 = new User();
        $user2->setEmail('jane@doe.fr');
        $user2->setPassword($this->hasher->hashPassword($user2, '654321'));
        $user2->setName('Doe');
        $user2->setFirstName('Jane');
        $user2->setPhoneNumber('0606060601');
        $user2->setCampus($this->getReference('campus_niort'));
        $user2->setIsVerified(true);
        $manager->persist($user2);

        $user3 = new User();
        $user3->setEmail('teddy@riner.fr');
        $user3->setPassword($this->hasher->hashPassword($user3, '987654'));
        $user3->setName('Riner');
        $user3->setFirstName('Teddy');
        $user3->setPhoneNumber('0606060602');
        $user3->setCampus($this->getReference('campus_rennes'));
        $user3->setIsVerified(true);
        $manager->persist($user3);

        $manager->flush();
    }


    public function getDependencies(): array
    {
        return [
            CampusFixtures::class
        ];
    }
}
