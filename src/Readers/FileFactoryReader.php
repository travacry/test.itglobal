<?php

declare(strict_types=1);

namespace PhpReader\Readers;

final class FileFactoryReader implements FactoryReaderInterface
{
    /**
     * @var array<string>
     */
    private array $available;

    /**
     * @var array<string, Reader>
     */
    private static array $map = [];

    public function __construct(private readonly AvailableReadersInterface $readers)
    {
        $this->available = $this->readers->getAvailable();
    }

    /**
     * @throws ReadersException
     */
    private function get(string $className): Reader
    {
        if (isset(self::$map[$className])) {
            return self::$map[$className];
        }
        $classNameWithNs = $this->available[$className];

        $reader = new $classNameWithNs();

        if (!$reader instanceof Reader) {
            throw new ReadersException("Wrong type. Created object with class name $className 
            does not match what is expected. Use class names with an interface Reader.");
        }
        self::$map[$className] = $reader;
        return self::$map[$className];
    }

    /**
     * @throws ReadersException
     */
    public function created(ChoiceInterface $choice): Reader
    {
        $className = $choice->getClassName();
        if (key_exists($className, $this->available) === false) {
            throw new ReadersException('Reader class selected incorrectly : '. $className);
        }

        return $this->get($className);
    }
}
