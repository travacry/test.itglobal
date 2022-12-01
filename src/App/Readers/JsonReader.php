<?php

declare(strict_types=1);

namespace App\Readers;

final class JsonReader implements Reader
{

    /**
     * @param string $pathToFile
     * @return array<int, string|null>
     * @throws \Exception
     */
    function read(string $pathToFile): array
    {
        $contents = file_get_contents($pathToFile);
        if ($contents === false) {
            throw new \Exception('Information lost file not correct');
        }
        $data = json_decode($contents, true);
        if (!is_array($data)) {
            throw new \Exception('Incorrect conversion file is corrupted or data is invalid.');
        }
        return $data;
    }
}