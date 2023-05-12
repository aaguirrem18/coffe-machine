<?php

declare(strict_types=1);

namespace Adsmurai\CoffeeMachine\Billing\Application;

use Adsmurai\CoffeeMachine\Drink\Application\GetDrinks;
use Adsmurai\CoffeeMachine\Billing\Application\FindBilling;
use Adsmurai\CoffeeMachine\Billing\Domain\BillingRepository;
use Adsmurai\CoffeeMachine\Billing\Application\CreateBilling;

final class UpdateBilling
{
    private $repository;

    public function __construct(BillingRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Getting drinks to check if the drink exists on table billings
     * if exists is updated
     * else is save as a new drink
     * 
     * @param string $drink drink_type selected
     */
    public function execute(string $drink): void
    {
        $getDrinks = new GetDrinks();
        $drinks_costs = $getDrinks->execute();

        $find = new FindBilling($this->repository);
        $drink_to_update = $find->execute($drink);

        if (empty($drink_to_update)) {
            $save = new CreateBilling($this->repository);
            $save->execute($drink, $drinks_costs[$drink]);
        } else {
            $this->repository->update(
                $drink_to_update->id,
                $drink_to_update->money + $drinks_costs[$drink]
            );
        }
    }
}
