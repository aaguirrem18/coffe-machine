<?php

declare(strict_types=1);

namespace Adsmurai\CoffeeMachine\Order\Domain\ValueObject;

use Adsmurai\CoffeeMachine\Order\Domain\Exception\InvalidSugarValue;

final class Sugars
{

    private $sugars;

    public function __construct($sugars)
    {
        $this->validate($sugars);
        $this->sugars = (int) $sugars;
    }

    /**
     * sugars
     *
     * @return int
     */
    public function value(): int
    {
        return $this->sugars;
    }

    public function validate($sugars)
    {
        if (!in_array($sugars, [0, 1, 2])) {
            throw new InvalidSugarValue('The number of sugars should be between 0 and 2.');
        }
    }
}
