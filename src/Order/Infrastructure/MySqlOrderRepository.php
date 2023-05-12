<?php

namespace Adsmurai\CoffeeMachine\Order\Infrastructure;

use Adsmurai\CoffeeMachine\Order\Domain\Order;
use Adsmurai\CoffeeMachine\Order\Domain\OrderRepository;
use Adsmurai\CoffeeMachine\shared\Infrastructure\MysqlPdoClient;

final class MySqlOrderRepository implements OrderRepository
{

    public $connection;

    public function __construct()
    {
        $this->connection = MysqlPdoClient::getPdo();
    }

    public function save(Order $order)
    {
        $query = "INSERT INTO orders (drink_type, sugars, stick, extra_hot) VALUES (:drink_type, :sugars, :stick, :extra_hot)";
        $sql = $this->connection->prepare($query);
        $sql->bindValue(':drink_type', $order->getDrinkType()->value());
        $sql->bindValue(':sugars', $order->getSugars()->value());
        $sql->bindValue(':stick', $order->getStick());
        $sql->bindValue(':extra_hot', $order->getExtraHot()->value());
        return $sql->execute();
    }
}
