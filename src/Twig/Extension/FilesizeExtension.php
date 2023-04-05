<?php

namespace App\Twig\Extension;

use App\Twig\Runtime\FilesizeExtensionRuntime;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class FilesizeExtension extends AbstractExtension {
    public function getFilters(): array {
        return [
            new TwigFilter(
                'human_readable_format',
                [FilesizeExtensionRuntime::class, 'humanReadableFormat'],
                ['is_safe' => ['html']]
            ),
        ];
    }

    public function getFunctions(): array {
        return [
            new TwigFunction(
                'human_readable_format',
                [FilesizeExtensionRuntime::class, 'humanReadableFormat'],
                ['is_safe' => ['html']]
            ),
        ];
    }
}
