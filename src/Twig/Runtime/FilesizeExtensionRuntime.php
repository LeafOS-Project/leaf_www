<?php

namespace App\Twig\Runtime;

use App\Util\Filesize;
use Twig\Extension\RuntimeExtensionInterface;

class FilesizeExtensionRuntime implements RuntimeExtensionInterface {
    public function humanReadableFormat($value) {
        return Filesize::humanReadableFormat((int)$value);
    }
}
