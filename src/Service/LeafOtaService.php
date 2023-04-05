<?php

namespace App\Service;

use App\Entity\LeafOta;
use App\Repository\LeafOtaRepository;
use DateTime;

class LeafOtaService {
    public function __construct(
        private LeafOtaRepository $repository
    ) {}

    public function getLatestBuildForDevice(string $device, string $flavor = ''): ?LeafOta {
        return $this->repository->getLatestBuildForDevice($device, $flavor);
    }

    public function getLatestOTAForDevice(string $device, string $flavor = ''): ?LeafOta {
        return $this->repository->getLatestOTAForDevice($device, $flavor);
    }

    public function getAllBuildsForDevice(string $device, string $flavor = ''): array {
        return $this->repository->getAllBuildsForDevice($device, $flavor);
    }

    public function getAllOTAsForDevice(string $device, string $flavor = ''): array {
        return $this->repository->getAllOTAsForDevice($device, $flavor);
    }
}