<?php

declare(strict_types=1);

namespace Adsmurai\CoffeeMachine\Order\Application;

use Adsmurai\CoffeeMachine\Order\Domain\Order;
use Adsmurai\CoffeeMachine\Drink\Application\GetDrinks;
use Adsmurai\CoffeeMachine\Order\Domain\OrderRepository;
use Adsmurai\CoffeeMachine\Order\Domain\ValueObject\Sugars;
use Adsmurai\CoffeeMachine\Order\Domain\ValueObject\ExtraHot;
use Adsmurai\CoffeeMachine\Order\Domain\ValueObject\DrinkType;
use Adsmurai\CoffeeMachine\Order\Domain\Exception\InvalidDrinkType;
use Adsmurai\CoffeeMachine\Order\Domain\Exception\InsufficientAmount;

final class CreateOrder
{
    private $repository;

    public function __construct(OrderRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(string $drink_type, float $money, $sugars, ?int $extra_hot): Order
    {
        $this->validateDrinkandPrice($drink_type, $money);

        $order = Order::create(
            new DrinkType($drink_type),
            new Sugars($sugars),
            new ExtraHot($extra_hot)
        );

        $this->repository->save($order);

        return $order;
    }

    /**
     * Return the message with details for the requested order
     *
     * @var Order representation of the new order make
     */
    public function getMessage($order): string
    {
        $message = "You have ordered a " . $order->getDrinkType()->value();
        
        if ($order->getExtraHot()->value()) {
            $message .= " extra hot";
        }

        $sugars = $order->getSugars()->value();
        if ($sugars > 0) {
            $message .= " with " . $sugars . " sugars (stick included)";
        }

        return $message;
    }
    
    /**
     * Validation of drink and price for the requested order
     *
     * @var string $drink_selected drink selected on the order
     * @var float $amount_give money give by the user to pay the order
     */
    private function validateDrinkandPrice($drink_selected, $amount_give): void
    {
        $getDrinks = new GetDrinks();
        $drinks = $getDrinks->execute();

        //if the drink give not exists on drink database
        if (false === array_key_exists($drink_selected, $drinks)) {
            throw new InvalidDrinkType('The drink type should be ' . implode(", ", $drinks));
        }

        //if the money give is less than the costs of drink
        if ($amount_give < $drinks[$drink_selected]) {
            throw new InsufficientAmount('The ' . $drink_selected . ' costs ' . (string) $drinks[$drink_selected] . ".");
        }
    }
}
