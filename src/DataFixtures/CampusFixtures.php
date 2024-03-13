<?php

namespace App\DataFixtures;

use App\Entity\Campus;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CampusFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $campusNantes = new Campus();
        $campusNantes->setName('Nantes');

        $manager->persist($campusNantes);
        $this->addReference('campus_nantes',$campusNantes);

        $campusRennes =new Campus();
        $campusRennes->setName('Rennes');
        $manager->persist($campusRennes);
        $this->addReference('campus_rennes',$campusRennes);

        $campusNiort =new Campus();
        $campusNiort->setName('Niort');
        $manager->persist($campusNiort);
        $this->addReference('campus_niort',$campusNiort);

        $campusQuimper =new Campus();
        $campusQuimper->setName('Quimper');
        $manager->persist($campusQuimper);
        $this->addReference('campus_quimper',$campusQuimper);


        $manager->flush();

    }
}
