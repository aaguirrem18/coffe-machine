<?php

namespace Adsmurai\CoffeeMachine\Billing\Infrastructure\Console;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use Adsmurai\CoffeeMachine\Billing\Application\GetTotalBilling;
use Adsmurai\CoffeeMachine\Billing\Infrastructure\MySqlBillingRepository;

class GetTotalEarnedCommmand extends Command
{
    protected static $defaultName = 'app:money-earned';

    protected function configure()
    {
        
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try {
            $get_billings = new GetTotalBilling(new MySqlBillingRepository());
            $totals = $get_billings->execute();
        } catch (\PDOException $e) {
            $output->writeln($e->getMessage());
            return;
        }

        $output->writeln($get_billings->getMessage($totals));
    }
}
