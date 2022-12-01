<?php

declare(strict_types=1);

namespace App;

use App\Helper\FileInfo;
use App\Readers\ChoiceClassNameByExtension;
use App\Readers\FactoryReader;

class FileReaderService
{
    protected FileInfo $fileInfo;
    protected ChoiceClassNameByExtension $choice;

    /**
     * @throws Helper\FileException
     * @throws Readers\ReadersException
     */
    public function read(string $pathToFile) : void {

        $this->fileInfo = new FileInfo($pathToFile);
        $this->choice = new ChoiceClassNameByExtension($this->fileInfo);

        $factoryReader = new FactoryReader();
        $reader = $factoryReader->created($this->choice);
        $reader->read($this->fileInfo->getFullPath());
    }
}