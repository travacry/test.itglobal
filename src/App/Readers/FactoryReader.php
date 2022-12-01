<?php

declare(strict_types=1);

namespace App\Readers;

final class FactoryReader implements FactoryReaderInterface
{
    /**
     * @var array<string>
     */
    protected array $available = [
        CsvReader::class,
        JsonReader::class
    ];
    /**
     * @var array<string, Reader>
     */
    protected static array $map = [];

    /**
     * @throws ReadersException
     */
    private function check(string $className) : bool {
        if (array_key_exists($className, $this->available) === false) {
            throw new ReadersException('Reader class selected incorrectly : '. $className);
        }
        return true;
    }

    private function get(string $className) : Reader {

        if (isset(self::$map[$className])) {
            return self::$map[$className];
        }
        $reader = new $className();
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
    public function created(ChoiceInterface $choice): Reader {
        $className = $choice->getClassName();
        $this->check($className);
        $reader = new ${$this->get($className)}();
        if (!$reader instanceof Reader) {
            throw new ReadersException("Wrong type. Created object with class name $className 
            does not match what is expected. Use class names with an interface Reader.");
        }
        return $reader;
    }

}