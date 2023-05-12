<?php

declare(strict_types=1);

namespace Adsmurai\CoffeeMachine\Billing\Application;

use Adsmurai\CoffeeMachine\Billing\Domain\Billing;
use Adsmurai\CoffeeMachine\Billing\Domain\BillingRepository;
use Adsmurai\CoffeeMachine\Billing\Domain\ValueObject\Money;
use Adsmurai\CoffeeMachine\Billing\Domain\ValueObject\BillingDrink;

final class CreateBilling
{
    private $repository;

    public function __construct(BillingRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(string $drink, float $money)
    {
        $drink = new BillingDrink($drink);
        $money = new Money($money);

        $billing = Billing::create($drink, $money);
        
        return $this->repository->save($billing);
    }
}
