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

        $location5 = new Location();
        $location5->setName('Cineville');
        $location5->setStreet('Rue Marie Curie');
        $location5->setLatitude(47.191296);
        $location5->setLongitude(-1.488433);
        $location5->setCity($this->getReference('city_saintsebastien'));
        $manager->persist($location5);
        $this->addReference('location_cineville', $location5);

        $location6 = new Location();
        $location6->setName('Patinoire Nantes');
        $location6->setStreet('Bd du Petit Port');
        $location6->setLatitude(47.2385);
        $location6->setLongitude(-1.5563);
        $location6->setCity($this->getReference('city_nantes'));
        $manager->persist($location6);
        $this->addReference('location_patinoire', $location6);

        $location7 = new Location();
        $location7->setName('L\'Antipode');
        $location7->setStreet('75 avenue Jules Maniez');
        $location7->setLatitude(48.1136);
        $location7->setLongitude(-1.6773);
        $location7->setCity($this->getReference('city_rennes'));
        $manager->persist($location7);
        $this->addReference('location_antipode', $location7);

        $location8 = new Location();
        $location8->setName('Bonobo Parc');
        $location8->setStreet('45 Rue du président Sadate');
        $location8->setLatitude(47.98100463070951);
        $location8->setLongitude( -4.098364255311936);
        $location8->setCity($this->getReference('city_quimper'));
        $manager->persist($location8);
        $this->addReference('location_bonobo', $location8);

        $location9 = new Location();
        $location9->setName('Théatre Jean Richard');
        $location9->setStreet('202 avenue Saint-Jean d\'Angély');
        $location9->setLatitude(46.316838719462304);
        $location9->setLongitude(-0.464446);
        $location9->setCity($this->getReference('city_niort'));
        $manager->persist($location9);
        $this->addReference('location_theatre', $location9);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            CityFixtures::class
        ];
    }
}
