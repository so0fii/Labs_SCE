<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CarRepository;
use App\Service\CacheManager;

class DefaultController extends AbstractController
{

    public function __construct(
        private readonly CarRepository $carRepository,
        private readonly CacheManager $cacheManager
    )
    {

    }
    #[Route('/hello/demo', name: 'app_hello_demo')]
    public function helloDemo(): Response
    {
        $carsInfo = $this->cacheManager->get('carsInfo');
        if (!$carsInfo) {
            $numberCars = count($this->carRepository->findAll());
            $numberOfToyota = count($this->carRepository->findCarsWithIdGreater(2));
            $carsInfo = ['number_cars' => $numberCars, 'number_of_toyota' => $numberOfToyota];
            $this->cacheManager->set('carsInfo', json_encode($carsInfo));
            } else {
                $carsInfo = json_decode($carsInfo, true);
            }
        $allCars = $this->carRepository->findAll();

        return $this->render(
            'demo/hello_demo.html.twig',
            [
                'cars' => $allCars,
                'carsInfo' => $carsInfo
            ]
        );
    }

    #[Route('/hello/toyota', name: 'app_hello_toyota')]
    public function helloToyota(): Response
    {
        $allToyota = $this->carRepository->findBy(['name' => 'Toyota']);
        $numberOfToyota = count($allToyota);

        return $this->render(
            'demo/hello_toyota.html.twig',
            [
                'number_of_toyota' => $numberOfToyota,
                'cars' => $allToyota,
            ]
        );
    }
}
