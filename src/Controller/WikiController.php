<?php

namespace App\Controller;

use App\Enum\OtaFlavor;
use App\Service\DeviceService;
use App\Service\LeafOtaService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WikiController extends AbstractController {
    #[Route('/wiki', name: 'leaf_wiki')]
    public function index(DeviceService $deviceService): Response {
        return $this->render(
            'wiki/index.html.twig',
            [
                'showSidenav' => true,
                'availableDevices' => $deviceService->getAvailableDevices()
            ]
        );
    }

    #[Route('/wiki/{device}', name: 'leaf_device')]
    public function device(DeviceService $deviceService, LeafOtaService $otaService, string $device): Response {
        $latestBuilds = [
            'vanilla' => $otaService->getLatestBuildForDevice($device, OtaFlavor::Vanilla->value),
            'gms'     => $otaService->getLatestBuildForDevice($device, OtaFlavor::Gms->value),
            'microg'  => $otaService->getLatestBuildForDevice($device, OtaFlavor::microG->value)
        ];

        $latestOTAs = [
            'vanilla' => $otaService->getLatestOTAForDevice($device, OtaFlavor::Vanilla->value),
            'gms'     => $otaService->getLatestOTAForDevice($device, OtaFlavor::Gms->value),
            'microg'  => $otaService->getLatestOTAForDevice($device, OtaFlavor::microG->value)
        ];

        $allBuilds = $otaService->getAllBuildsForDevice($device);
        $allOTAs = $otaService->getAllOTAsForDevice($device);

        return $this->render(
            'wiki/device.html.twig',
            [
                'showSidenav' => true,
                'availableDevices' => $deviceService->getAvailableDevices(),
                'device' => $deviceService->getDeviceInfo($device),
                'downloads' => [
                    'latestBuilds' => $latestBuilds,
                    'latestOTAs' => $latestOTAs,
                    'previousBuilds' => $allBuilds,
                    'previousOTAs' => $allOTAs
                ]
            ]
        );
    }
}
