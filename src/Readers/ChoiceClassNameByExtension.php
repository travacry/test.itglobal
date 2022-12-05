<?php

declare(strict_types=1);

namespace PhpReader\Readers;

use PhpReader\Helper\FileInfo;
use PhpReader\Helper\FileInfoInterface;

final class ChoiceClassNameByExtension implements ChoiceInterface
{
    private string $choice;

    /**
     * @param FileInfo $fileInfo
     * @return void
     * @throws ReadersException
     */
    public function set(FileInfoInterface $fileInfo): void
    {
        if ($fileInfo->isEmpty()) {
            throw new ReadersException('Use set method in class FileInfo.');
        }
        $this->choice = ucfirst($fileInfo->getExtension()) . 'Reader';
    }

    /**
     * @throws ReadersException
     */
    public function getClassName(): string
    {
        if (empty($this->choice)) {
            throw new ReadersException('Wrong choice : ' . $this->choice);
        }
        return $this->choice;
    }
}
