<?php

declare(strict_types=1);

namespace Adsmurai\CoffeeMachine\Order\Domain\Exception;

use InvalidArgumentException;

final class InvalidSugarValue extends InvalidArgumentException
{
    public function __construct(string $message, $code = 0)
    {
        parent::__construct($message, $code);
    }
}
