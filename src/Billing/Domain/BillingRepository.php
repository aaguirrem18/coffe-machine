<?php

namespace Adsmurai\CoffeeMachine\Billing\Domain;

use Adsmurai\CoffeeMachine\Billing\Domain\Billing;

interface BillingRepository
{
    public function all();
    public function save(Billing $billing);
    public function find(string $drink);
    public function update(int $id, float $money): void;
}
