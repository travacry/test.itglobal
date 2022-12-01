<?php

declare(strict_types=1);

namespace App\Helper\Path;

use SplFileInfo;

final class GetDirByPath
{
    static function by(string $path): string {
        return (new SplFileInfo($path))->getPath();
    }
}