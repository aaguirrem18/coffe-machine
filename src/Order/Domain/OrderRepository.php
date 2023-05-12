<?php

namespace Adsmurai\CoffeeMachine\Order\Domain;

use Adsmurai\CoffeeMachine\Order\Domain\Order;

interface OrderRepository
{
    public function save(Order $order);
}
