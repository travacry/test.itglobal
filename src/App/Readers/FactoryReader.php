<?php

declare(strict_types=1);

namespace App\Readers;

final class FactoryReader implements FactoryReaderInterface
{
    /**
     * @var string[]
     */
    protected array $available = [
        CsvReader::class,
        JsonReader::class
    ];
    /**
     * @var String<Reader>[]
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

        self::$map[$className] = new $className();
        return self::$map[$className];
    }

    /**
     * @throws ReadersException
     */
    public function created(ChoiceInterface $choice): Reader {
        $className = $choice->getClassName();
        $this->check($className);
        return new ${$this->get($className)}();
    }

}