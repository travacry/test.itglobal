<?php

namespace PhpReader\Tests\Unit\Readers;

use PhpReader\Helper\FileInfo;
use PhpReader\Readers\ChoiceClassNameByExtension;
use PhpReader\Readers\ReadersException;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class ChoiceClassNameByExtensionTest extends TestCase
{
    private ChoiceClassNameByExtension $object;
    /**
     * @var MockObject
     */
    private MockObject $fileInfo;

    protected function setUp(): void
    {
        $this->fileInfo = $this->createMock(FileInfo::class);
        $this->object = new ChoiceClassNameByExtension();
    }

    public function testSetWithEmptyFileInfo(): void
    {
        $fileInfo = $this->fileInfo;
        $fileInfo->expects($this->any())
            ->method('isEmpty')
            ->willReturn(true);
        $this->expectException(ReadersException::class);
        $this->expectExceptionMessage('Use set method in class FileInfo.');
        /**
         * @var FileInfo $fileInfo
         */
        $this->object->set($fileInfo);
    }

    public function testGetClassName(): void
    {
        $fileInfo = $this->fileInfo;
        $fileInfo->expects($this->any())
            ->method('isEmpty')
            ->willReturn(false);
        $fileInfo
            ->method('getExtension')
            ->willReturn('json');
        /**
         * @var FileInfo $fileInfo
         */
        $this->object->set($fileInfo);
        $className = $this->object->getClassName();
        $this->assertEquals('JsonReader', $className);
    }
}
