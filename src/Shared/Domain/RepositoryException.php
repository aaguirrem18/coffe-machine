<?php

declare(strict_types=1);

namespace Adsmurai\CoffeeMachine\shared\Domain\Exception;

use PDOException;

final class RepositoryException extends PDOException
{
    public function __construct(string $message, $code = 0)
    {
        parent::__construct($message, $code);
    }
}
