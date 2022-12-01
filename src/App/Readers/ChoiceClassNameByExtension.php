<?php

declare(strict_types=1);

namespace App\Readers;
use App\Helper\FileInfo;

final class ChoiceClassNameByExtension implements ChoiceInterface
{
    private string $choice;

    public function __construct(FileInfo $fileInfo)
    {
        $this->choice = ucfirst($fileInfo->getExtension()) . 'Reader';
    }

    /**
     * @throws ReadersException
     */
    public function getClassName() : string {
        if (empty($this->choice)) {
            throw new ReadersException('Wrong choice : ' . $this->choice);
        }
        return $this->choice;
    }
}