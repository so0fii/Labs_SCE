<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CarRepository;

class DefaultController extends AbstractController
{

    public function __construct(
        private readonly CarRepository $carRepository,
    )
    {

    }
    #[Route('/hello/demo', name: 'app_hello_demo')]
    public function helloDemo(): Response
    {
        $firstCar = $this->carRepository->find(1);
        return $this->render(
            'demo/hello_demo.html.twig',
            [
                'text' => $firstCar->getName(),
            ]
        );
    }
}
