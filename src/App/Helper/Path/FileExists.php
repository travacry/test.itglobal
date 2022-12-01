<?php

declare(strict_types=1);

namespace App\Helper\Path;

use SplFileInfo;

final class FileExists
{
    public static function by(string $path): bool
    {
        return (new SplFileInfo($path))->isFile();
    }
}
