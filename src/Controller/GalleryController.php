<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GalleryController extends AbstractController {
    #[Route('/gallery', name: 'leaf_gallery')]
    public function index(): Response {
        $screenshots = array_filter(scandir($this->getParameter('screenshots_dir')), function ($item) {
            return !in_array($item, ['.', '..']);
        });

        natsort($screenshots);
        return $this->render(
            'gallery/index.html.twig',
            ['screenshots' => $screenshots]
        );
    }
}
