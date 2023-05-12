<?php

declare(strict_types=1);

namespace Adsmurai\CoffeeMachine\Billing\Application;

use Adsmurai\CoffeeMachine\Billing\Domain\BillingRepository;

final class GetTotalBilling
{
    private $repository;

    public function __construct(BillingRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(): ?array
    {
        $billings = $this->repository->all();
        return $billings;
    }

    /**
     * Fast way to know the total money earned, used in GetTotalEarnedCommmand
     * @param array $billings data from database in array type
     */
    public function getMessage(array $billings): string
    {
        if (empty($billings)) {
            return "There are no orders yet. Total: 0";
        }

        $message = "Money Earned:" . PHP_EOL;
        foreach ($billings as $billing) {
            $message .= " drink: " . $billing['drink'] . " | total: " . $billing['money'] . PHP_EOL;
        }

        return $message;
    }

}
