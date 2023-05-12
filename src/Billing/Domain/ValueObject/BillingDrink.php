<?php

declare(strict_types=1);

namespace Adsmurai\CoffeeMachine\Billing\Domain\ValueObject;

final class BillingDrink
{
    private $drink;

    public function __construct(string $drink)
    {
        $this->drink = $drink;
    }

    public function value(): string
    {
        return $this->drink;
    }
}
