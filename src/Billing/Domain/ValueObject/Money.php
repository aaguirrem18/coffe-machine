<?php

declare(strict_types=1);

namespace Adsmurai\CoffeeMachine\Billing\Domain\ValueObject;

final class Money
{
    private $money;

    public function __construct(float $money)
    {
        $this->money = $money;
    }

    public function value(): float
    {
        return $this->money;
    }
}
