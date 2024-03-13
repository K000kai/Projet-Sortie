<?php

namespace App\DataFixtures;

use App\Entity\City;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CityFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $city1= new City();
        $city1->setName('Nantes');
        $city1->setPostCode(44000);
        $manager->persist($city1);
        $this->addReference('city_nantes',$city1);

        $city2 =new City();
        $city2->setName('Rennes');
        $city2->setPostCode(35000);
        $manager->persist($city2);
        $this->addReference('city_rennes',$city2);

        $city3 =new City();
        $city3->setName('Niort');
        $city3->setPostCode(79000);
        $manager->persist($city3);
        $this->addReference('city_niort',$city3);

        $city4 =new City();
        $city4->setName('Quimper');
        $city4->setPostCode(29000);
        $manager->persist($city4);
        $this->addReference('city_quimper',$city4);

        $city5 =new City();
        $city5->setName('La Roche-sur-Yon');
        $city5->setPostCode(85000);
        $manager->persist($city5);
        $this->addReference('city_larochesuryon',$city5);

        $city6 =new City();
        $city6->setName('Saint-Herblain');
        $city6->setPostCode(44800);
        $manager->persist($city6);
        $this->addReference('city_saintherblain',$city6);

        $city7 =new City();
        $city7->setName('Saint-Sebastien');
        $city7->setPostCode(44230);
        $manager->persist($city7);
        $this->addReference('city_saintsebastien',$city7);


        $manager->flush();
    }
}
