<?php

namespace App\DataFixtures;

use App\Entity\Beer;
use App\Entity\Client;
use App\Entity\Statistic;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class StatisticFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $beerRepo = $manager->getRepository(Beer::class);
        $clientRepo = $manager->getRepository(Client::class);

        $beers = $beerRepo->findAll();

        foreach ($clientRepo->findAll() as $client) {
            shuffle($beers);
            $beersNumberForOneClient = random_int(1, count($beers) / 2);

            for ($i=0 ; $i < $beersNumberForOneClient ; $i++) {
                $newStatistic = new Statistic();
                $randomScore = random_int(0, 10);

                $newStatistic->setBeer($beers[$i]);
                $newStatistic->setClient($client);
                $newStatistic->setScore($randomScore);
                $manager->persist($newStatistic);
            }
        }
        $manager->flush();
    }

    public function  getDependencies() {
        return [
            AppFixtures::class,
            ClientFixtures::class
        ];
    }
}
