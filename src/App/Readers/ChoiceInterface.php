<?php

declare(strict_types=1);

namespace App\Readers;

interface ChoiceInterface
{
    function getClassName(): string;
}