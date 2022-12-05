<?php

declare(strict_types=1);

namespace PhpReader\Readers;

use PhpReader\Helper\FileInfo;

interface ChoiceInterface
{
    public function set(FileInfo $fileInfo): void;
    public function getClassName(): string;
}
