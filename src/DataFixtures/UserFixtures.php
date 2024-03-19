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
        $user->setProfile($this->getReference('profile_1'));
        $manager->persist($user);
        $this->addReference('user_1', $user);

        $user2 = new User();
        $user2->setEmail('jane@doe.fr');
        $user2->setPassword($this->hasher->hashPassword($user2, '654321'));
        $user2->setName('Doe');
        $user2->setFirstName('Jane');
        $user2->setPhoneNumber('0606060601');
        $user2->setCampus($this->getReference('campus_niort'));
        $user2->setIsVerified(true);
        $user2->setProfile($this->getReference('profile_2'));
        $manager->persist($user2);
        $this->addReference('user_2', $user2);

        $user3 = new User();
        $user3->setEmail('teddy@riner.fr');
        $user3->setPassword($this->hasher->hashPassword($user3, '987654'));
        $user3->setName('Riner');
        $user3->setFirstName('Teddy');
        $user3->setPhoneNumber('0606060602');
        $user3->setCampus($this->getReference('campus_rennes'));
        $user3->setIsVerified(true);
        $user3->setProfile($this->getReference('profile_3'));
        $manager->persist($user3);
        $this->addReference('user_3', $user3);

        $user4 = new User();
        $user4->setEmail('romain.bougouin@gmail.com');
        $user4->setPassword($this->hasher->hashPassword($user4, '123456'));
        $user4->setName('Bougouin');
        $user4->setFirstName('Romain');
        $user4->setPhoneNumber('0606060603');
        $user4->setCampus($this->getReference('campus_quimper'));
        $user4->setIsVerified(true);
        $user4->setProfile($this->getReference('profile_4'));
        $manager->persist($user4);
        $this->addReference('user_4', $user4);

        $user5 = new User();
        $user5->setEmail('olivia.gendt@gmail.com');
        $user5->setPassword($this->hasher->hashPassword($user5, '123456'));
        $user5->setName('Gendt');
        $user5->setFirstName('Olivia');
        $user5->setPhoneNumber('0606060604');
        $user5->setCampus($this->getReference('campus_rennes'));
        $user5->setIsVerified(true);
        $user5->setProfile($this->getReference('profile_5'));
        $manager->persist($user5);
        $this->addReference('user_5', $user5);

        $user6 = new User();
        $user6->setEmail('eli.eli@gmail.com');
        $user6->setPassword($this->hasher->hashPassword($user6, '123456'));
        $user6->setName('N\'Diath');
        $user6->setFirstName('Eli');
        $user6->setPhoneNumber('0606060605');
        $user6->setCampus($this->getReference('campus_niort'));
        $user6->setIsVerified(true);
        $manager->persist($user6);
        $this->addReference('user_6', $user6);

        $user7 = new User();
        $user7->setEmail('alexis.caillet@gmail.com');
        $user7->setPassword($this->hasher->hashPassword($user7, '123456'));
        $user7->setName('Caillet');
        $user7->setFirstName('Alexis');
        $user7->setPhoneNumber('0606060607');
        $user7->setCampus($this->getReference('campus_quimper'));
        $user7->setIsVerified(true);
        $user7->setProfile($this->getReference('profile_7'));
        $manager->persist($user7);
        $this->addReference('user_7', $user7);

        $user8 = new User();
        $user8->setEmail('hugo.hopital@gmail.com');
        $user8->setPassword($this->hasher->hashPassword($user8, '123456'));
        $user8->setName('Hopital');
        $user8->setFirstName('Hugo');
        $user8->setPhoneNumber('0606060608');
        $user8->setCampus($this->getReference('campus_rennes'));
        $user8->setIsVerified(true);
        $user8->setProfile($this->getReference('profile_8'));
        $manager->persist($user8);
        $this->addReference('user_8', $user8);

        $user9 = new User();
        $user9->setEmail('benedicte.hautebas@gmail.com');
        $user9->setPassword($this->hasher->hashPassword($user9, '123456'));
        $user9->setName('Hautebas');
        $user9->setFirstName('Bénédicte');
        $user9->setPhoneNumber('0606060609');
        $user9->setCampus($this->getReference('campus_nantes'));
        $user9->setIsVerified(true);
        $user9->setProfile($this->getReference('profile_9'));

        $manager->persist($user9);
        $this->addReference('user_9', $user9);

        $user10 = new User();
        $user10->setEmail('erwan.jadeau@gmail.com');
        $user10->setPassword($this->hasher->hashPassword($user10, '123456'));
        $user10->setName('Jadeau');
        $user10->setFirstName('Erwan');
        $user10->setPhoneNumber('0606060610');
        $user10->setCampus($this->getReference('campus_quimper'));
        $user10->setIsVerified(true);
        $user10->setProfile($this->getReference('profile_10'));
        $manager->persist($user10);
        $this->addReference('user_10', $user10);


        $manager->flush();
    }


    public function getDependencies(): array
    {
        return [
            CampusFixtures::class,
            ProfileFixtures::class
        ];
    }
}
