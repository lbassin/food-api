<?php

declare(strict_types=1);

namespace App\Infrastructure\Exception;

use App\Domain\Exception\ExceptionTypes;
use Throwable;

class MissingDataForDTOException extends \RuntimeException
{
    public function __construct(array $fields, Throwable $previous = null)
    {
        $message = sprintf(
            'Mandatory fields are not provided in the request. Fields expected: %s',
            implode(', ', $fields)
        );

        parent::__construct($message, ExceptionTypes::APPLICATION, $previous);
    }
}
