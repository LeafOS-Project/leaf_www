<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AboutController extends AbstractController
{
    #[Route('/charter', name: 'leaf_charter')]
    public function index(): Response
    {
        return $this->render('charter/index.html.twig');
    }
}