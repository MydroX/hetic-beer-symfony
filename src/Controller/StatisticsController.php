<?php

namespace App\Controller;

use App\Entity\Client;
use App\Entity\Statistic;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/statistics')]
class StatisticsController extends AbstractController
{
    #[Route("/", name: "statistics")]
    public function statistics() {
        $doctrine = $this->getDoctrine();
        $statsRepo = $doctrine->getRepository(Statistic::class);
        $clientRepo = $doctrine->getRepository(Client::class);

        $clients = $clientRepo->findAll();
        $beerSellNumber = 0;
        foreach ($clients as $client) {
            $beerSellNumber += $client->getBeerNumberPurchased();
        }
        $averageBeerSalePerClient = $beerSellNumber / count($clients);

        return $this->render("statistics/index.html.twig", [
            "title" => "statistics",
            "averagePerClient" => $averageBeerSalePerClient
        ]);
    }

    #[Route("/clients", name: 'clients_statistics')]
    public function clientsStatistics() {
        $doctrine = $this->getDoctrine();
        $statsRepo = $doctrine->getRepository(Statistic::class);
        $clientRepo = $doctrine->getRepository(Client::class);

        $clients = $clientRepo->findAll();

        return $this->render("statistics/clients.html.twig", [
            "title" => "statistics clients",
            "clients" => $clients
        ]);
    }
}
