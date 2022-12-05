<?php

namespace PhpReader\Tests\Unit\Readers;

use PhpReader\Readers\AvailableReaders;
use PhpReader\Readers\CsvReader;
use PhpReader\Readers\JsonReader;
use PhpReader\Readers\ReadersException;
use PHPUnit\Framework\TestCase;

class AvailableReadersTest extends TestCase
{
    private AvailableReaders $object;
    public const NAME_READERS = [
        CsvReader::class,
        JsonReader::class,
    ];
    public const COMPARE_READERS = [
        'CsvReader' => 'PhpReader\Readers\CsvReader',
        'JsonReader' => 'PhpReader\Readers\JsonReader',
    ];

    protected function setUp(): void
    {
        $this->object = new AvailableReaders();
    }

    public function testSetClassNameReadersWithEmptyClassNames(): void
    {
        $this->expectException(ReadersException::class);
        $this->expectExceptionMessage('Empty $classNames. Exz : [CsvReader::class, JsonReader::class]');
        $this->object->setClassNameReaders([]);
    }

    public function testGetAvailable(): void
    {
        $this->object->setClassNameReaders(self::NAME_READERS);
        $object = $this->object->getAvailable();
        self::assertEquals(self::COMPARE_READERS, $object);
    }
}
