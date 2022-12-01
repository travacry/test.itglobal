<?php

declare(strict_types=1);

namespace App\Readers;

interface ChoiceInterface
{
    public function getClassName(): string;
}
