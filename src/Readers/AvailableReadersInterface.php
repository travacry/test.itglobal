<?php

declare(strict_types=1);

namespace PhpReader\Readers;

interface AvailableReadersInterface
{
    /**
     * @return array<string>
     */
    public function getAvailable(): array;
}
