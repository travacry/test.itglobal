<?php

namespace PhpReader\Tests\Unit\Readers;

use PhpReader\Readers\AvailableReadersInterface;
use PhpReader\Readers\ChoiceInterface;
use PhpReader\Readers\FileFactoryReader;
use PhpReader\Readers\JsonReader;
use PhpReader\Readers\ReadersException;
use PhpReader\Tests\Unit\ClassReaders\JsonxReader;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class FileFactoryReaderTest extends TestCase
{
    private FileFactoryReader $object;
    /**
     * @var MockObject
     */
    private MockObject $availableReaders;
    /**
     * @var MockObject
     */
    private MockObject $choice;

    public const COMPARE_READERS = [
        'CsvReader' => 'PhpReader\Readers\CsvReader',
        'JsonReader' => 'PhpReader\Readers\JsonReader',
    ];

    protected function setUp(): void
    {
        $this->availableReaders = $this->createMock(AvailableReadersInterface::class);
        $this->choice = $this->createMock(ChoiceInterface::class);
    }

    public function testCreated(): void
    {
        $availableReaders = $this->availableReaders;
        $availableReaders->expects($this->any())
            ->method('getAvailable')
            ->willReturn(self::COMPARE_READERS);

        $choice = $this->choice;
        $choice->expects($this->any())
            ->method('getClassName')
            ->willReturn('JsonReader');
        /**
         * @var AvailableReadersInterface $availableReaders
         * @var ChoiceInterface $choice
         */
        $this->object = new FileFactoryReader($availableReaders);
        $reader = $this->object->created($choice);
        $this->assertInstanceOf(JsonReader::class, $reader);
    }

    public function testCreatedWithNotCreatedClassName(): void
    {
        $availableReaders = $this->availableReaders;
        $availableReaders->expects($this->any())
            ->method('getAvailable')
            ->willReturn(self::COMPARE_READERS);

        $choice = $this->choice;
        $choice->expects($this->any())
            ->method('getClassName')
            ->willReturn('JsonReader_');
        /**
         * @var AvailableReadersInterface $availableReaders
         * @var ChoiceInterface $choice
         */
        $this->object = new FileFactoryReader($availableReaders);
        $this->expectException(ReadersException::class);
        $this->expectExceptionMessage('Reader class selected incorrectly : JsonReader_');
        $this->object->created($choice);
    }

    public function testCreatedWithNewReader(): void
    {
        $availableReaders = $this->availableReaders;
        $availableReaders->expects($this->any())
            ->method('getAvailable')
            ->willReturn([ 'JsonxReader' => JsonxReader::class ]);

        $choice = $this->choice;
        $choice->expects($this->any())
            ->method('getClassName')
            ->willReturn('JsonxReader');
        /**
         * @var AvailableReadersInterface $availableReaders
         * @var ChoiceInterface $choice
         */
        $this->object = new FileFactoryReader($availableReaders);
        $reader = $this->object->created($choice);
        $this->assertInstanceOf(JsonxReader::class, $reader);
    }
}
