<?php

namespace Adsmurai\CoffeeMachine\Billing\Infrastructure;

use Adsmurai\CoffeeMachine\Billing\Domain\Billing;
use Adsmurai\CoffeeMachine\Billing\Domain\BillingRepository;
use Adsmurai\CoffeeMachine\shared\Infrastructure\MysqlPdoClient;
use Adsmurai\CoffeeMachine\shared\Domain\Exception\RepositoryException;

final class MySqlBillingRepository implements BillingRepository
{

    public $connection;

    public function __construct()
    {
        $this->connection = MysqlPdoClient::getPdo();
    }

    public function all()
    {
        try {
            $query = "SELECT * FROM billings";
            $sql = $this->connection->prepare($query);
            $sql->execute();
            return $sql->fetchAll();
        } catch (\PDOException $e) {
            throw new RepositoryException("Error Getting Billings: " . $e->getMessage());
        }
    }

    public function save(Billing $billing)
    {
        try {
            $query = "INSERT INTO billings (drink, money) VALUES (:drink, :money)";
            $sql = $this->connection->prepare($query);
            $sql->bindValue(':drink', $billing->getDrink()->value());
            $sql->bindValue(':money', $billing->getMoney()->value());
            $sql->execute();
        } catch (\PDOException $e) {
            throw new RepositoryException("Error Saving Billings: " . $e->getMessage());
        }
    }

    public function find(string $drink)
    {
        try {
            $query = "SELECT * FROM billings WHERE drink = (:drink)";
            $sql = $this->connection->prepare($query);
            $sql->bindValue(':drink', $drink);
            $sql->execute();
            return $sql->fetch(\PDO::FETCH_OBJ);
        } catch (\PDOException $e) {
            throw new RepositoryException("Error Serching Billings: " . $e->getMessage());
        }
    }

    public function update(int $id, float $money): void
    {
        try {
            $query = "UPDATE billings SET money = (:money) WHERE id = (:id)";
            $sql = $this->connection->prepare($query);
            $sql->bindValue(':id', $id);
            $sql->bindValue(':money', $money);
            $sql->execute();
        } catch (\PDOException $e) {
            throw new RepositoryException("Error Updating Billings: " . $e->getMessage());
        }

    }
}
