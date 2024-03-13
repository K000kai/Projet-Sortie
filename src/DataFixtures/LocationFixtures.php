<?php

namespace App\DataFixtures;

use App\Entity\Location;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class LocationFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $location1 = new Location();
        $location1->setName('BowlCenter');
        $location1->setStreet('Rue Moulin de la Rousselière ');
        $location1->setLatitude(47,2363656);
        $location1->setLongitude(-1,5666281);
        $location1->setCity($this->getReference('city_saintherblain'));
        $manager->persist($location1);
        $this->addReference('location_bowlcenter', $location1);

        $location2 = new Location();
        $location2->setName('Burger King Saint-Sebastien');
        $location2->setStreet(' Zac Des Gripots, Rue Marie Curie');
        $location2->setLatitude(47.191296);
        $location2->setLongitude(-1.488433);
        $location2->setCity($this->getReference('city_saintsebastien'));
        $manager->persist($location2);
        $this->addReference('location_burgerking', $location2);

        $location3 = new Location();
        $location3->setName('Pub Guiness');
        $location3->setStreet('Rue du Moulin de la Rousselière');
        $location3->setLatitude(47.23106);
        $location3->setLongitude(-1.639516);
        $location3->setCity($this->getReference('city_saintherblain'));
        $manager->persist($location3);
        $this->addReference('location_pubguiness', $location3);

        $location4 = new Location();
        $location4->setName('Meltdown');
        $location4->setStreet('15 All. des Tanneurs,');
        $location4->setLatitude(47.21987367089689);
        $location4->setLongitude(-1.5563453940742433);
        $location4->setCity($this->getReference('city_nantes'));
        $manager->persist($location4);
        $this->addReference('location_meltdown', $location4);

        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            CityFixtures::class
        ];
    }
}
