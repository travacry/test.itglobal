<?php

declare(strict_types=1);

namespace App\Helper\Path;

use SplFileInfo;

final class GetFileNameByPath
{
    public static function by(string $path): string
    {
        return (new SplFileInfo($path))->getFilename();
    }
}
