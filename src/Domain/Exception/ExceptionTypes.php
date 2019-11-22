<?php

declare(strict_types=1);

namespace App\Domain\Exception;

abstract class ExceptionTypes
{
    const GENERIC = 0;

    const NOT_FOUND = 1;

    const DATA_PROVIDED_ERROR = 2;

    CONST DOMAIN = 3;

    CONST APPLICATION = 4;
}
