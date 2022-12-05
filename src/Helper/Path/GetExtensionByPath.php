<?php

declare(strict_types=1);

namespace PhpReader\Helper\Path;

use SplFileInfo;

final class GetExtensionByPath
{
    public static function by(string $path): string
    {
        return (new SplFileInfo($path))->getExtension();
    }
}
