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
        $manager->flush();
    }
}
