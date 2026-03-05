<?php

namespace App\Controller;

use App\Entity\Brand;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BrandController extends AbstractController
{
    #[Route('/brands', name: 'brands_index')]
    public function index(EntityManagerInterface $em): Response
    {
        $brands = $em->getRepository(Brand::class)->findAll();

        return $this->render('brand/index.html.twig', [
            'brands' => $brands,
        ]);
    }
}
