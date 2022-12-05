<?php

declare(strict_types=1);

namespace PhpReader\Helper;

interface FileInfoInterface
{
    public function set(string $path): void;
    public function getFileName(): string;
    public function getDir(): string;
    public function getExtension(): string;
    public function getFullPath(): string;
    public function isEmpty(): bool;
}
