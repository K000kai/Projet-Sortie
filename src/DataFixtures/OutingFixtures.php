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

        $outing3 = new Outing();
        $outing3->setName('Soirée Cinéma');
        $outing3->setDateTimeStart(new \DateTime('2024-04-25 20:00:00'));
        $outing3->setDuration(180);
        $outing3->setRegistrationDeadline(new \DateTime('2024-04-23'));
        $outing3->setNbRegistrationMax(15);
        $outing3->setCampus($this->getReference('campus_nantes'));
        $outing3->setLocation($this->getReference('location_cineville'));
        $outing3->setStatus($this->getReference('status_open'));
        $outing3->setOrganizer($this->getReference('user_7'));
        $outing3->setInfoOuting('Venez voir un film avec nous !');
        $manager->persist($outing3);

        $outing4 = new Outing();
        $outing4->setName('Concert BigFlo et Oli');
        $outing4->setDateTimeStart(new \DateTime('2024-04-30 20:00:00'));
        $outing4->setDuration(180);
        $outing4->setRegistrationDeadline(new \DateTime('2024-04-28'));
        $outing4->setNbRegistrationMax(10);
        $outing4->setCampus($this->getReference('campus_rennes'));
        $outing4->setLocation($this->getReference('location_antipode'));
        $outing4->setStatus($this->getReference('status_open'));
        $outing4->setOrganizer($this->getReference('user_6'));
        $outing4->setInfoOuting('Venez voir un concert avec nous !');
        $manager->persist($outing4);

        $outing5 = new Outing();
        $outing5->setName('Soirée Patinoire');
        $outing5->setDateTimeStart(new \DateTime('2024-03-30 20:00:00'));
        $outing5->setDuration(120);
        $outing5->setRegistrationDeadline(new \DateTime('2024-03-29'));
        $outing5->setNbRegistrationMax(30);
        $outing5->setCampus($this->getReference('campus_nantes'));
        $outing5->setLocation($this->getReference('location_patinoire'));
        $outing5->setStatus($this->getReference('status_open'));
        $outing5->setOrganizer($this->getReference('user_1'));
        $outing5->setInfoOuting('Venez patiner avec nous !');
        $manager->persist($outing5);

        $outing6 = new Outing();
        $outing6->setName('Journée Acrobranche');
        $outing6->setDateTimeStart(new \DateTime('2024-05-15 10:00:00'));
        $outing6->setDuration(240);
        $outing6->setRegistrationDeadline(new \DateTime('2024-05-14'));
        $outing6->setNbRegistrationMax(20);
        $outing6->setCampus($this->getReference('campus_quimper'));
        $outing6->setLocation($this->getReference('location_bonobo'));
        $outing6->setStatus($this->getReference('status_open'));
        $outing6->setOrganizer($this->getReference('user_10'));
        $outing6->setInfoOuting('Venez vous amuser avec nous !');
        $manager->persist($outing6);

        $outing7 = new Outing();
        $outing7->setName('Sortie Théatre');
        $outing7->setDateTimeStart(new \DateTime('2024-05-20 20:00:00'));
        $outing7->setDuration(120);
        $outing7->setRegistrationDeadline(new \DateTime('2024-05-19'));
        $outing7->setNbRegistrationMax(10);
        $outing7->setCampus($this->getReference('campus_niort'));
        $outing7->setLocation($this->getReference('location_theatre'));
        $outing7->setStatus($this->getReference('status_open'));
        $outing7->setOrganizer($this->getReference('user_9'));
        $outing7->setInfoOuting('Venez voir une pièce de théatre avec nous !');
        $manager->persist($outing7);



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
