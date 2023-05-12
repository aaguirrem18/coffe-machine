<?php

namespace Adsmurai\CoffeeMachine\Order\Infrastructure\Console;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;

use Symfony\Component\Console\Output\OutputInterface;

use Adsmurai\CoffeeMachine\Drink\Application\GetDrinks;
use Adsmurai\CoffeeMachine\Order\Application\CreateOrder;
use Adsmurai\CoffeeMachine\Billing\Application\UpdateBilling;
use Adsmurai\CoffeeMachine\Order\Domain\Exception\InvalidDrinkType;
use Adsmurai\CoffeeMachine\Order\Domain\Exception\InvalidSugarValue;

use Adsmurai\CoffeeMachine\Order\Domain\Exception\InsufficientAmount;
use Adsmurai\CoffeeMachine\Order\Infrastructure\MySqlOrderRepository;
use Adsmurai\CoffeeMachine\Billing\Infrastructure\MySqlBillingRepository;

class MakeDrinkCommand extends Command
{
    protected static $defaultName = 'app:order-drink';

    protected function configure()
    {
        $this->addArgument(
            'drink-type',
            InputArgument::REQUIRED,
            'The type of the drink. (Tea, Coffee or Chocolate)'
        );

        $this->addArgument(
            'money',
            InputArgument::REQUIRED,
            'The amount of money given by the user'
        );

        $this->addArgument(
            'sugars',
            InputArgument::OPTIONAL,
            'The number of sugars you want. (0, 1, 2)',
            0
        );

        $this->addOption(
            'extra-hot',
            'e',
            InputOption::VALUE_NONE,
            'If the user wants to make the drink extra hot'
        );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try {
            $drink_type = $input->getArgument('drink-type');

            $create_order = new CreateOrder(new MySqlOrderRepository());
            $order = $create_order->execute(
                $drink_type, 
                $input->getArgument('money'),
                $input->getArgument('sugars'),
                $input->getOption('extra-hot')
            );
            
            $update_billing = new UpdateBilling(new MySqlBillingRepository());
            $update_billing->execute($drink_type);

        } catch (InvalidDrinkType $e) {
            $output->writeln($e->getMessage());
            return;
        } catch (InsufficientAmount $e) {
            $output->writeln((string)$e->getMessage());
            return;
        } catch (InvalidSugarValue $e) {
            $output->writeln($e->getMessage());
            return;
        } catch (\PDOException $e) {
            $output->writeln($e->getMessage());
            return;
        }

        $output->writeln($create_order->getMessage($order));
    }
}
