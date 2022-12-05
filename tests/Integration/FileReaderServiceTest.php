<?php

namespace PhpReader\Tests\Integration;

use PhpReader\FileReaderService;
use PhpReader\Helper\FileInfo;
use PhpReader\Readers\AvailableReaders;
use PhpReader\Readers\ChoiceClassNameByExtension;
use PhpReader\Readers\CsvReader;
use PhpReader\Readers\FileFactoryReader;
use PhpReader\Readers\JsonReader;
use PHPUnit\Framework\TestCase;

class FileReaderServiceTest extends TestCase
{
    public const FULL_PATH = '/tmp/data.json';
    private FileReaderService $object;
    private FileInfo $fileInfo;
    private ChoiceClassNameByExtension $choice;
    private AvailableReaders $availableReaders;
    /**
     * @var array<string|int, mixed>
     */
    private array $readData = [];

    protected function setUp(): void
    {
        $this->fileInfo = new FileInfo();
        $this->choice = new ChoiceClassNameByExtension();
        $this->availableReaders = new AvailableReaders();

        if (!file_exists(self::FULL_PATH)) {
            $this->readData = [567 => 1, 'sdfgs' => 'asdfasdf', 645 => ['345', 'test5' => 'dfgsdf', 44]];
            file_put_contents(self::FULL_PATH, json_encode($this->readData));
        }
    }

    protected function tearDown(): void
    {
        unlink(self::FULL_PATH);
    }

    public function testRead(): void
    {
        $this->assertFileIsReadable(self::FULL_PATH);

        $this->availableReaders->setClassNameReaders([CsvReader::class, JsonReader::class]);
        $factoryReader = new FileFactoryReader($this->availableReaders);
        $this->object = new FileReaderService($this->fileInfo, $this->choice, $factoryReader);
        $data = $this->object->read(self::FULL_PATH);
        $this->assertEquals($this->readData, $data);
    }
}
