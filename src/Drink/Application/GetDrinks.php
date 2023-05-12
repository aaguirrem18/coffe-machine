<?php
/**
 *  Sample Drink use case to get the drinks into database
 * @author: Adolfo Aguirre Montes
 */

declare(strict_types=1);

namespace Adsmurai\CoffeeMachine\Drink\Application;

final class GetDrinks
{
    //private $repository;

    public function __construct(/*DrinkRepository $repository*/)
    {
        //$this->repository = $repository;
    }

    public function execute(): array
    {
        //return $this->repository->all();
        return ['tea' => 0.4, 'coffee' => 0.5, 'chocolate' => 0.6];
    }
}
