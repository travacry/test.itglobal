<?php

declare(strict_types=1);

namespace App\Readers;

interface Reader
{
    /**
     * @param string $pathToFile
     * @return array<int, mixed>
     */
    public function read(string $pathToFile): array;
}