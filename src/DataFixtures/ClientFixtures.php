<?php

namespace App\DataFixtures;

use App\Entity\Client;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ClientFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $maxClientNumber = 10;
        $firstnames = ["bernard", "antoine", "damien", "cyril", "mohamed", "paul", "matthieu", "gabin", "gael", "brice", "arthur", "anthony", "julien", "charles"];
        $lastnames = ["ollivon", "leroux", "dupont", "penaud", "haouas", "willemse", "jalibert", "villiere", "fickou", "dulin", "vincent", "jelonch", "marchand"];
        $domains = ["gmail.com", "orange.fr", "yahoo.fr", "hotmail.fr", "outlook.com"];

        for ($i=0 ; $i < $maxClientNumber; $i++) {
            $newClient = new Client();

            $email = $firstnames[random_int(1, count($firstnames) - 1)] . "." . $lastnames[random_int(1, count($lastnames) - 1)] . "@" . $domains[random_int(1, count($domains) - 1)];

            $newClient->setName($firstnames[random_int(1, count($firstnames) - 1)] . "_". $i);
            $newClient->setEmail($email);
            $newClient->setBeerNumberPurchased(random_int(1, 20));
            $newClient->setWeight(random_int(50, 140));
            $newClient->setAge(random_int(13, 105));

            $manager->persist($newClient);
        }

        $manager->flush();
    }
}
