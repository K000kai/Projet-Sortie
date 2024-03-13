<?php

namespace App\DataFixtures;

use App\Entity\Status;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class StatusFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $status1= new Status();
        $status1->setLibelle('Créée');
        $manager->persist($status1);
        $this->addReference('status_created',$status1);

        $status2 =new Status();
        $status2->setLibelle('Ouverte');
        $manager->persist($status2);
        $this->addReference('status_open',$status2);

        $status3 =new Status();
        $status3->setLibelle('Clôturée');
        $manager->persist($status3);
        $this->addReference('status_closed',$status3);

        $status4 =new Status();
        $status4->setLibelle('En cours');
        $manager->persist($status4);
        $this->addReference('status_inprogress',$status4);

        $status5 =new Status();
        $status5->setLibelle('Passée');
        $manager->persist($status5);
        $this->addReference('status_past',$status5);

        $status6 =new Status();
        $status6->setLibelle('Annulée');
        $manager->persist($status6);
        $this->addReference('status_canceled',$status6);

        $manager->flush();
    }
}
