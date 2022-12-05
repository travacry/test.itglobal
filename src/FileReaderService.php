<?php

declare(strict_types=1);

namespace PhpReader;

use PhpReader\Helper\FileInfo;
use PhpReader\Helper\FileInfoInterface;
use PhpReader\Readers\ChoiceClassNameByExtension;
use PhpReader\Readers\ChoiceInterface;
use PhpReader\Readers\FactoryReaderInterface;
use PhpReader\Readers\FileFactoryReader;

class FileReaderService
{
    /**
     * @param FileInfo $fileInfo
     * @param ChoiceClassNameByExtension $choice
     * @param FileFactoryReader $factoryReader
     */
    public function __construct(
        private readonly FileInfoInterface $fileInfo,
        private readonly ChoiceInterface $choice,
        private readonly FactoryReaderInterface $factoryReader
    ) {
    }

    /**
     * @return array<string|int, mixed>
     * @throws Readers\ReadersException
     * @throws Helper\FileException
     */
    public function read(string $pathToFile): array
    {
        $this->fileInfo->set($pathToFile);
        $this->choice->set($this->fileInfo);
        $reader = $this->factoryReader->created($this->choice);
        return $reader->read($this->fileInfo->getFullPath());
    }
}
