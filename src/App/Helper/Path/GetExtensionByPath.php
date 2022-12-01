<?php

declare(strict_types=1);

namespace App\Helper\Path;

final class GetExtensionByPath
{
    public static function by(string $path): string {
        return (new \SplFileInfo($path))->getExtension();
    }
}