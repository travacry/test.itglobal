<?php

declare(strict_types=1);

namespace App\Readers;

interface FactoryReaderInterface
{
    public function created(ChoiceInterface $choice): Reader;
}
