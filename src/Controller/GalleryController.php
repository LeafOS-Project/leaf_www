<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GalleryController extends AbstractController {
    #[Route('/gallery', name: 'leaf_gallery')]
    public function index(): Response {
        $baseDir = $this->getParameter('screenshots_dir');
        $directories = array_filter(scandir($baseDir), function ($item) {
            $baseDir = $this->getParameter('screenshots_dir');
            return is_dir($baseDir . '/' . $item) && !in_array($item, ['.', '..']);
        });

        $screenshots = [];

        foreach ($directories as $directory) {
            $screenshots[$directory] = array_filter(scandir($baseDir . '/' . $directory), function ($item) {
                return !in_array($item, ['.', '..']);
            });
            natsort($screenshots[$directory]);
        }

        return $this->render(
            'gallery/index.html.twig',
            ['screenshots' => $screenshots]
        );
    }
}
