<?php

namespace App\DataFixtures;

use App\Entity\Profile;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProfileFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
         $profile1 = new Profile();
         $profile1->setUsername('JohnDoe44');
         $profile1->setName('Doe');
         $profile1->setSurname('John');
         $profile1->setPhone('0606060606');
         $profile1->setEmail('john@doe.fr');
         $profile1->setCampus('Nantes');
         $manager->persist($profile1);
         $this->addReference('profile_1', $profile1);

         $profile2 = new Profile();
         $profile2->setUsername('JaneDoe44');
         $profile2->setName('Doe');
         $profile2->setSurname('Jane');
         $profile2->setPhone('0606060601');
         $profile2->setEmail('jane@doe.fr');
         $profile2->setCampus('Niort');
         $manager->persist($profile2);
         $this->addReference('profile_2', $profile2);

         $profile3= new Profile();
         $profile3->setUsername('TR44');
         $profile3->setName('Riner');
         $profile3->setSurname('Teddy');
         $profile3->setPhone('0606060602');
         $profile3->setEmail('teddy@riner.fr');
         $profile3->setCampus('Rennes');

         $manager->persist($profile3);
         $this->addReference('profile_3', $profile3);

         $profile4= new Profile();
         $profile4->setUsername('RB44');
         $profile4->setName('Bougouin');
         $profile4->setSurname('Romain');
         $profile4->setPhone('0606060603');
         $profile4->setEmail('romain.bougouin@gmail.com');
         $profile4->setCampus('Quimper');

         $manager->persist($profile4);
         $this->addReference('profile_4', $profile4);

         $profile5= new Profile();
         $profile5->setUsername('OG44');
         $profile5->setName('Gendt');
         $profile5->setSurname('Olivia');
         $profile5->setPhone('0606060604');
         $profile5->setEmail('olivia.gendt@gmail.com');
         $profile5->setCampus('Rennes');
         $manager->persist($profile5);
         $this->addReference('profile_5', $profile5);


         $profile7= new Profile();
         $profile7->setUsername('AC44');
         $profile7->setName('Caillet');
         $profile7->setSurname('Alexis');
         $profile7->setPhone('0606060607');
         $profile7->setEmail('alexis.caillet@gmail.com');
         $profile7->setCampus('Quimper');

         $manager->persist($profile7);
         $this->addReference('profile_7', $profile7);

         $profile8= new Profile();
         $profile8->setUsername('HH44');
         $profile8->setName('Hopital');
         $profile8->setSurname('Hugo');
         $profile8->setPhone('0606060608');
         $profile8->setEmail('hugo.hopital@gmail.com');
         $profile8->setCampus('Rennes');
         $manager->persist($profile8);
         $this->addReference('profile_8', $profile8);

         $profile9= new Profile();
         $profile9->setUsername('BH44');
         $profile9->setName('Hautebas');
         $profile9->setSurname('Bénédicte');
         $profile9->setPhone('0606060609');
         $profile9->setEmail('benedicte.hautebas@gmail.com');
         $profile9->setCampus('Nantes');

         $manager->persist($profile9);
         $this->addReference('profile_9', $profile9);

         $profile10= new Profile();
         $profile10->setUsername('EJ44');
         $profile10->setName('Jadeau');
         $profile10->setSurname('Erwan');
         $profile10->setPhone('0606060610');
         $profile10->setEmail('erwan.jadeau@gmail.com');
         $profile10->setCampus('Quimper');

         $manager->persist($profile10);
         $this->addReference('profile_10', $profile10);

         $manager->flush();
     }




}
