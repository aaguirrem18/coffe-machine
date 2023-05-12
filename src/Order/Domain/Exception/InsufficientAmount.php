<?php

declare(strict_types=1);

namespace Adsmurai\CoffeeMachine\Order\Domain\Exception;

use Exception;

final class InsufficientAmount extends Exception
{
    public function __construct(string $message, $code = 0)
    {
        parent::__construct($message, $code);
    }
}
