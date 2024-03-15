<?php

namespace App\DataFixtures;

use App\Entity\Outing;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use function Symfony\Component\String\s;

class OutingFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $outing1 = new Outing();
        $outing1->setName('Soirée Bowling');
        $outing1->setDateTimeStart(new \DateTime('2024-04-15 20:00:00'));
        $outing1->setDuration(120);
        $outing1->setRegistrationDeadline(new \DateTime('2024-04-14'));
        $outing1->setNbRegistrationMax(20);
        $outing1->setCampus($this->getReference('campus_nantes'));
        $outing1->setLocation($this->getReference('location_bowlcenter'));
        $outing1->setStatus($this->getReference('status_open'));
        $outing1->setOrganizer($this->getReference('user_1'));
        $outing1->setInfoOuting('Venez vous amuser avec nous !');
        $manager->persist($outing1);

        $outing2 = new Outing();
        $outing2->setName('Soirée Bar');
        $outing2->setDateTimeStart(new \DateTime('2024-04-20 20:00:00'));
        $outing2->setDuration(60);
        $outing2->setRegistrationDeadline(new \DateTime('2024-04-19'));
        $outing2->setNbRegistrationMax(10);
        $outing2->setCampus($this->getReference('campus_rennes'));
        $outing2->setLocation($this->getReference('location_pubguiness'));
        $outing2->setStatus($this->getReference('status_open'));
        $outing2->setOrganizer($this->getReference('user_2'));
        $outing2->setInfoOuting('Venez boire une verre !');
        $manager->persist($outing2);

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
            CityFixtures::class,
            CampusFixtures::class,
            LocationFixtures::class,
            StatusFixtures::class,

        ];
    }
}
