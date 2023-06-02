<?php

namespace App\Service;

use App\Exception\DeviceNotFoundException;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Yaml\Yaml;

class DeviceService {
    private string $devicesDirectory;

    public function __construct(
        #[Autowire(service: 'service_container')] ContainerInterface $container
    ) {
        $this->devicesDirectory = $container->getParameter('devices_dir');
    }

    public function getAvailableDevices(): array {
        $availableDevices = scandir($this->devicesDirectory);

        return array_filter(array_map(function (string $deviceYaml) {
            if (!in_array($deviceYaml, ['..', '.'])) {
                return Yaml::parseFile($this->devicesDirectory . $deviceYaml);
            }
        }, $availableDevices));
    }

    public function getDeviceVendors(): array {
        $availableDevices = $this->getAvailableDevices();
        $vendors = [];

        foreach ($availableDevices as $device) {
            $vendor = $device['vendor'];
            if (!array_key_exists($vendor, $vendors)) {
                $vendors[$vendor] = [];
            }
            $vendors[$vendor][] = $device;
        }

        return $vendors;
    }

    public function getDeviceInfo(string $device) {
        $file = $this->devicesDirectory . $device . '.yml';

        if (is_file($file)) {
            return Yaml::parseFile($file);
        } else {
            throw new DeviceNotFoundException("The device \"" . $device . "\" doesn't exist.");
        }
    }
}
