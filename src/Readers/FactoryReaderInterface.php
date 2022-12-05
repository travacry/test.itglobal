<?php

declare(strict_types=1);

namespace PhpReader\Readers;

interface FactoryReaderInterface
{
    public function created(ChoiceInterface $choice): Reader;
}
