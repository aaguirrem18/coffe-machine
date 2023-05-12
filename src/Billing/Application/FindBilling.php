<?php

declare(strict_types=1);

namespace Adsmurai\CoffeeMachine\Billing\Application;

use Adsmurai\CoffeeMachine\Billing\Domain\BillingRepository;
use Adsmurai\CoffeeMachine\Billing\Domain\ValueObject\BillingDrink;

final class FindBilling
{
    private $repository;

    public function __construct(BillingRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(string $drink)
    {
        return $this->repository->find($drink);
    }
}
