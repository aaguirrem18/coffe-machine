<?php

declare(strict_types=1);

namespace Adsmurai\CoffeeMachine\Billing\Domain;

use Adsmurai\CoffeeMachine\Billing\Domain\ValueObject\Money;
use Adsmurai\CoffeeMachine\Billing\Domain\ValueObject\BillingDrink;

final class Billing
{
    private $drink;
    private $money;

    public function __construct(BillingDrink $drink, Money $money)
    {
        $this->drink = $drink;
        $this->money = $money;
    }

    public static function create(BillingDrink $drink, Money $money): self
    {
        $billing = new self($drink, $money);
        return $billing;
    }

    public function getDrink(): BillingDrink
    {
        return $this->drink;
    }

    public function getMoney(): Money
    {
        return $this->money;
    }
}
