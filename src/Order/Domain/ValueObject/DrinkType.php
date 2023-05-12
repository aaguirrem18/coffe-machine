<?php

declare(strict_types=1);

namespace Adsmurai\CoffeeMachine\Order\Domain\ValueObject;

use Adsmurai\CoffeeMachine\Order\Domain\Exception\InvalidDrinkType;

final class DrinkType
{

    private string $drink_type;

    public function __construct(string $drink_type)
    {
        $this->drink_type = $drink_type;
    }

    /**
     * getDrinkType
     *
     * @return string
     */
    public function value(): string
    {
        return $this->drink_type;
    }
}
