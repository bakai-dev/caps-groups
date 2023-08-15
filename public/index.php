<?php

declare(strict_types=1);

use App\Exception\FruitGardenAutomationException;
use App\Console\FruitAutomationConsole;

require_once __DIR__ . '/../vendor/autoload.php';

$app = new FruitAutomationConsole();

try {
    $app->run();
} catch (FruitGardenAutomationException $e) {
    echo $e->getMessage();
}
