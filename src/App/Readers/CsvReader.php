<?php

declare(strict_types=1);

namespace App\Readers;

final class CsvReader implements Reader
{
    /**
     * @return array<int, mixed>
     * @throws \Exception
     */
    function read(string $pathToFile): array
    {
        $contents = file_get_contents($pathToFile);
        if ($contents === false) {
            throw new \Exception('Information lost file not correct');
        }
        return str_getcsv($contents);
    }
}