<?php

declare(strict_types=1);

namespace Adsmurai\CoffeeMachine\Order\Domain\ValueObject;

final class ExtraHot
{
    private $extra_hot;

    public function __construct(int $extra_hot)
    {
        $this->extra_hot = $extra_hot;
    }

    /**
     * extra_hot
     *
     * @return bool
     */
    public function value(): int
    {
        return $this->extra_hot;
    }
}
