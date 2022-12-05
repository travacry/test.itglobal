<?php

declare(strict_types=1);

namespace PhpReader\Readers;

interface Reader
{
    /**
     * @param string $pathToFile
     * @return array<string|int, mixed>
     */
    public function read(string $pathToFile): array;
}
