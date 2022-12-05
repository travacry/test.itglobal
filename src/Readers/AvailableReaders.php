<?php

declare(strict_types=1);

namespace PhpReader\Readers;

final class AvailableReaders implements AvailableReadersInterface
{
    /**
     * @var array<string>
     */
    protected array $available = [];

    /**
     * exz : [CsvReader::class, JsonReader::class]
     * @param array<string> $classNames
     * @return void
     * @throws ReadersException
     */
    public function setClassNameReaders(array $classNames): void
    {
        if (count($classNames) === 0) {
            throw new ReadersException('Empty $classNames. Exz : [CsvReader::class, JsonReader::class]');
        }
        $this->available = $classNames;
        $this->available = $this->mapping();
    }

    /**
     * @return array<string, string>
     */
    protected function mapping(): array
    {
        $tmp = [];
        foreach ($this->available as $next) {
            $lines = explode("\\", $next);
            $name = end($lines);
            $tmp[$name] = $next;
        }
        return $tmp;
    }

    /**
     * @return array<string>
     */
    public function getAvailable(): array
    {
        return $this->available;
    }
}
