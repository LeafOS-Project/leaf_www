<?php

namespace App\Util;

class Filesize {
    public static function humanReadableFormat(int $filesize): string {
        $units = ['B', 'kB', 'MB', 'GB', 'TB', 'PB'];
        $power = ($filesize > 0) ? floor(log($filesize, 1024)) : 0;

        return sprintf(
            '%01.2f %s',
            $filesize / pow(1024, $power),
            $units[$power]
        );
    }
}
