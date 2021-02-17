<?php

namespace App\Controller;

use App\Repository\BeerRepository;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Contracts\HttpClient\HttpClientInterface;

use App\Entity\Beer;
use App\Entity\Category;

class BarController extends AbstractController
{

    private $client;
    private $categories = ['Brune', 'Ambrée', 'Blanche', 'Sans alcool'];

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @Route("/bar", name="bar")
     */
    public function index(): Response
    {
        return $this->render('bar/index.html.twig', [
            'title' => 'The bar kkkkkk',
            'info' => 'Hello World'
        ]);
    }

    /**
     * @Route("/mentions", name="mentions")
     */
    public function mentions()
    {

        return $this->render('mentions/index.html.twig', [
            'title' => 'Mentions légales',
        ]);
    }

    /**
     * @Route("/beer/{id}", name="beer")
     */
    public function show(int $id): Response
    {
        $beerRepo = $this->getDoctrine()->getRepository(Beer::class);
        return $this->render('beer/index.html.twig', [
            "title" => "Page beer",
            'beer' => $beerRepo->findOneBy(["id" => $id])
        ]);
    }

    /**
     * @Route("/beers", name="beers")
     */
    public function beers()
    {
        $beerRepo = $this->getDoctrine()->getRepository(Beer::class);

        foreach ($beerRepo->findAll() as $beer) {
           dump($beer->getCountry());
        }
      
        return $this->render('beers/index.html.twig', [
            'title' => 'Page beers',
            'beers' => $beerRepo->findAll()
        ]);
    }

    /**
     * @Route("/", name="home")
     */
    public function home()
    {
        $beersRepo = $this->getDoctrine()->getRepository(Beer::class);
        $last3beers = $beersRepo->getLast3BeersOfTable();
        return $this->render('home/index.html.twig', [
            'title' => "Page d'accueil",
            "beers" => $last3beers
        ]);
    }

    /**
     * @Route("/newbeer", name="create_beer")
     */
    public function createBeer()
    {
        $entityManager = $this->getDoctrine()->getManager();

        $beer = new Beer();
        $beer->setname('Super Beer');
        $beer->setPublishedAt(new \DateTime());
        $beer->setDescription('Ergonomic and stylish!');

        // tell Doctrine you want to (eventually) save the Beer (no queries yet)
        $entityManager->persist($beer);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return new Response('Saved new beer with id ' . $beer->getId());
    }

    private function generateCat()
    {
        $entityManager = $this->getDoctrine()->getManager();

        foreach ($this->categories as $name) {
            $category = new Category(); // nouvel objet <=> une nouvelle entrée dans la base
            $category->setName($name);
            $entityManager->persist($category);
        }

        $entityManager->flush();
    }

    /**
     * @Route("/newbeercat", name="newbeercat")
     */
    public function createBeerCat()
    {
        $this->generateCat();
        $entityManager = $this->getDoctrine()->getManager();
        $repository = $this->getDoctrine()->getRepository(Category::class);

        $beer = new Beer();
        $beer->setName('Bière Ardèchoise');
        $beer->setPublishedAt(new \DateTime());
        $beer->setDescription('Ergonomic and stylish!');

        foreach ($repository->findAll() as $category) {
            $beer->addCategory($category);
        }

        $entityManager->persist($beer);

        $entityManager->flush();

        return new Response('ok beer into categories');
    }

     /**
     * @Route("/repo", name="repo")
     */
    public function repo(){

        $repository = $this->getDoctrine()->getRepository(Category::class);

        dump($repository->findByName('Ambrée'));

        return new Response('test repo');
    }

    /**
     * @Route("/menu", name="menu")
     */
    public function mainMenu(): Response{

        $categoriesRepo = $this->getDoctrine()->getRepository(Category::class);

        return $this->render('partial/main_menu.html.twig', [
            "categories" => $categoriesRepo->findBy(["term" => "normal"])
        ]);
    }

    /**
     * @Route("/category/{id}", name="category")
     */
    public function beerByCategory(Request $request): Response {
        $categoriesRepo = $this->getDoctrine()->getRepository(Category::class);
        $beersRepo = $this->getDoctrine()->getRepository(Beer::class);
        $id = $request->attributes->get("id");

        $category = $categoriesRepo->findOneBy(["id" => $id]);
        $beers = $beersRepo->getBeersByCategory($id);

        return $this->render("beers/category.html.twig", [
            "title" => "beers " . $category->getName(),
            "beers" => $beers
        ]);
    }
}
