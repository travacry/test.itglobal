<?php

declare(strict_types=1);

namespace App\Helper;

use App\Helper\Path;

final class FileInfo
{
    /**
     * @var array<string, string>
     */
    protected static array $map = [];
    private string $dir;
    private string $fileName;
    private string $extension;
    private string $fullPath;

    /**
     * @param string $path
     * @throws FileException
     */
    public function __construct(private readonly string $path)
    {
        $this->dir = $this->getDir();
        $this->fileName = $this->getFileName();
        $this->extension = $this->getExtension();
        $this->fullPath = $this->dir.DIRECTORY_SEPARATOR.$this->fileName;
    }

    /**
     * @throws FileException
     */
    public function getFileName() : string {

        if (!empty($this->fileName)) {
            return $this->fileName;
        }

        $fileName = Path\GetFileNameByPath::by($this->path);

        if (!Path\FileExists::by($fileName)) {
            throw new FileException('No such file found.');
        }

        return $fileName;
    }

    /**
     * @throws FileException
     */
    public function getDir() : string {

        if (!empty($this->dir)) {
            return $this->dir;
        }

        if (key_exists($this->path, self::$map)) {
            return self::$map[$this->path];
        }

        $dir = Path\GetDirByPath::by($this->path);
        if (!Path\DirExists::by($dir)) {
            throw new FileException('No such directory found.');
        }

        self::$map[$this->path] = $dir;
        return $dir;
    }

    public function getExtension() : string {

        if (!empty($this->extension)) {
            return $this->extension;
        }

        return Path\GetExtensionByPath::by($this->path);
    }

    public function getFullPath(): string
    {
        return $this->fullPath;
    }

}