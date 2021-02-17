<?php

namespace App\DataFixtures;

use App\Entity\Client;
use App\Entity\Statistic;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class StatisticFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $newStatistic = new Statistic();


    }

    public function  getDependencies() {
        return [
            AppFixtures::class,
            ClientFixtures::class
        ];
    }
}
