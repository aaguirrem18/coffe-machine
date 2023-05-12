#!/usr/bin/env php
<?php
// application.php

require __DIR__.'/vendor/autoload.php';

use Symfony\Component\Console\Application;
use Adsmurai\CoffeeMachine\Order\Infrastructure\Console\MakeDrinkCommand;
use Adsmurai\CoffeeMachine\Billing\Infrastructure\Console\GetTotalEarnedCommmand;

$application = new Application();

$application->add(new MakeDrinkCommand());
$application->add(new GetTotalEarnedCommmand());

$application->run();
