<?php

namespace Adsmurai\CoffeeMachine\Tests\Order;

use PHPUnit\Framework\TestCase;
use Adsmurai\CoffeeMachine\Order\Domain\Order;
use Adsmurai\CoffeeMachine\Order\Domain\ValueObject\Sugars;
use Adsmurai\CoffeeMachine\Order\Domain\ValueObject\ExtraHot;
use Adsmurai\CoffeeMachine\Order\Domain\ValueObject\DrinkType;
use Adsmurai\CoffeeMachine\Order\Domain\Exception\InvalidDrinkType;

class OrderTest extends TestCase
{

    public function testDrinkTypeIsValid()
    {
        $sugars = new Sugars(1);
        $extra_hot = new ExtraHot(0);

        $drink_type = new DrinkType("tea");
        $order = new Order($drink_type, $sugars, $extra_hot);

        $this->assertContains($order->getDrinkType()->value(), ['tea', 'coffee', 'chocolate'], "Expected drink_type to be 'tea', 'coffee', or 'chocolate'");
    }

    public function testValidDrinkType()
    {
        
        $sugars = new Sugars(1);
        $extra_hot = new ExtraHot(0);

        $drink_type = new DrinkType("tea");
        $order = new Order($drink_type, $sugars, $extra_hot);

        
        $this->assertEquals( $drink_type, $order->getDrinkType());
        
        $drink_type = new DrinkType("coffee");
        $order = new Order($drink_type, $sugars, $extra_hot);
        $this->assertEquals($drink_type, $order->getDrinkType());
        
        $drink_type = new DrinkType("chocolate");
        $order = new Order($drink_type, $sugars, $extra_hot);
        $this->assertEquals($drink_type, $order->getDrinkType());
    }

    public function testValidSugar()
    {
        $drink_type = new DrinkType("tea");
        $extra_hot = new ExtraHot(0);

        $sugars = new Sugars(0);
        $order = new Order($drink_type, $sugars,  $extra_hot);
        $this->assertEquals(0, $order->getSugars()->value());

        $sugars = new Sugars(1);
        $order = new Order($drink_type, $sugars,  $extra_hot);
        $this->assertEquals(1, $order->getSugars()->value());

        $sugars = new Sugars(2);
        $order = new Order($drink_type,$sugars,  $extra_hot);
        $this->assertEquals(2, $order->getSugars()->value());
    }

    public function testInvalidSugar()
    {
        $this->expectExceptionMessage('The number of sugars should be between 0 and 2');
        $sugars = new Sugars(10);
    }

}
