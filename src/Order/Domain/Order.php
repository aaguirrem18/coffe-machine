<?php

declare(strict_types=1);

namespace Adsmurai\CoffeeMachine\Order\Domain;

use Adsmurai\CoffeeMachine\Order\Domain\ValueObject\Sugars;
use Adsmurai\CoffeeMachine\Order\Domain\ValueObject\ExtraHot;
use Adsmurai\CoffeeMachine\Order\Domain\ValueObject\DrinkType;

/**
 * Class Order
 *
 * Represents a drink order
 *
 * @property DrinkType $drink_type representing Object Type of drink (tea, coffee, or chocolate)
 * @property Sugars $sugars Object representing the amount of sugars in the drink
 * @property ExtraHot $extra_hot Object representing if the drink should be extra hot
 */
final class Order
{
    private $drink_type;
    private $sugars;
    private $extra_hot;
    private int $stick;

    public function __construct(DrinkType $drink_type, Sugars $sugars, ExtraHot $extra_hot)
    {
        $this->drink_type = $drink_type;
        $this->sugars = $sugars;
        $this->stick = $this->setStick($sugars);
        $this->extra_hot = $extra_hot;
    }

    public static function create(DrinkType $drink_type, Sugars $sugars, ExtraHot $extra_hot): self
    {
        $order = new self($drink_type, $sugars, $extra_hot);
        return $order;
    }

    /**
     * Type of drink (tea, coffee, or chocolate)
     *
     * @var string
     */
    public function getDrinkType(): DrinkType
    {
        return $this->drink_type;
    }

    /**
     * Object representing the amount of sugars in the drink
     *
     * @var Sugars
     */
    public function getSugars(): Sugars
    {
        return $this->sugars;
    }

    /**
     * Object representing if the drink should be extra hot
     *
     * @var ExtraHot
     */
    public function getExtraHot(): ExtraHot
    {
        return $this->extra_hot;
    }

    /**
     * integer variable to know if the order has a stick, depending of has sugar
     *
     * @var int
     */
    public function getStick(): int
    {
        return $this->stick;
    }

    public function setStick(Sugars $sugars): int
    {
        return ($sugars->value() >= 1) ? 1 : 0;
    }
}
