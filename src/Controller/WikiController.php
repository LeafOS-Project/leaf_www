<?php

namespace App\Controller;

use App\Enum\OtaFlavor;
use App\Exception\WikiPageNotFoundException;
use App\Service\DeviceService;
use App\Service\LeafOtaService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;
use Twig\Loader\LoaderInterface;

class WikiController extends AbstractController {
    private LoaderInterface $loader;
    private array $availableDevices;
    private array $vendors;

    public function __construct(Environment $twig, private DeviceService $deviceService) {
        $this->loader = $twig->getLoader();
        $this->availableDevices = $deviceService->getAvailableDevices();
        $this->vendors = $deviceService->getDeviceVendors();
    }

    #[Route('/wiki', name: 'leaf_wiki')]
    public function index(): Response {
        return $this->render(
            'wiki/index.html.twig',
            [
                'showSidenav' => true,
                'availableDevices' => $this->availableDevices,
                'deviceVendors' => $this->vendors,
            ],
        );
    }

    #[Route('/wiki/device/{device}', name: 'leaf_wiki_device')]
    public function device(DeviceService $deviceService, LeafOtaService $otaService, string $device): Response {
        $latestBuilds = [
            'VANILLA' => $otaService->getLatestBuildForDevice($device, OtaFlavor::VANILLA->value),
            'GMS'     => $otaService->getLatestBuildForDevice($device, OtaFlavor::GMS->value),
            'microG'  => $otaService->getLatestBuildForDevice($device, OtaFlavor::microG->value)
        ];

        $latestOTAs = [
            'VANILLA' => $otaService->getLatestOTAForDevice($device, OtaFlavor::VANILLA->value),
            'GMS'     => $otaService->getLatestOTAForDevice($device, OtaFlavor::GMS->value),
            'microG'  => $otaService->getLatestOTAForDevice($device, OtaFlavor::microG->value)
        ];

        $allBuilds = $otaService->getAllBuildsForDevice($device);
        $allOTAs = $otaService->getAllOTAsForDevice($device);

        return $this->render(
            'wiki/device.html.twig',
            [
                'showSidenav' => true,
                'availableDevices' => $this->availableDevices,
                'device' => $deviceService->getDeviceInfo($device),
                'downloads' => [
                    'latestBuilds' => $latestBuilds,
                    'latestOTAs' => $latestOTAs,
                    'previousBuilds' => $allBuilds,
                    'previousOTAs' => $allOTAs
                ],
                'deviceVendors' => $this->vendors,
            ]
        );
    }

    #[Route('/wiki/how-to/{page}', name: 'leaf_wiki_howto')]
    public function howTos(string $page): Response {
        if ($this->loader->exists("wiki/how-to/{$page}.html.twig")) {
            return $this->render(
                "wiki/how-to/{$page}.html.twig",
                ['availableDevices' => $this->availableDevices]
            );
        } else {
            throw new WikiPageNotFoundException("The wiki page for \"{$page}\" doesn't exist.");
        }
    }
}
