<?php

declare(strict_types=1);

namespace App\Readers;

final class JsonReader implements Reader
{
    /**
     * @throws \Exception
     */
    function read($fileName): array
    {
        $contents = file_get_contents($fileName);
        if ($contents === false) {
            throw new \Exception('Information lost file not correct');
        }
        return json_decode($contents, true);
    }
}