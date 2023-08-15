<?php

declare(strict_types=1);

namespace App\Console;

use App\Exception\FruitGardenAutomationException;
use App\Service\FruitAutomationService;
use App\Entity\Fruit;

/**
 * Class FruitAutomationConsole
 * @package App\Console
 */
final class FruitAutomationConsole
{
    /**
     * Runs the fruit garden automation process.
     *
     * @return void
     * @throws FruitGardenAutomationException If an error occurs during the automation process.
     */
    public function run(): void
    {
        $fruitCount = readline("Enter the number of fruit types: ");
        $fruits = [];

        if (!is_numeric($fruitCount)) {
            // The entry was an incorrect number
            $errorMessage = 'Invalid input for fruit count. Please enter a valid number.';
            throw new FruitGardenAutomationException($errorMessage);
        }

        for ($i = 0; $i < $fruitCount; $i++) {
            $fruitName = readline("Enter fruit name: ");
            $ripeningTime = (int)readline("Enter ripening time for $fruitName (days): ");
            $harvestingTime = (int)readline("Enter harvesting time for $fruitName (minutes per fruit): ");
            $fruits[] = new Fruit($fruitName, $ripeningTime, $harvestingTime);
        }

        // Enter other parameters
        $transportTime = (int)readline("Enter transport time (minutes per fruit): ");
        $sortingTime = (int)readline("Enter sorting time (minutes per fruit): ");
        $juiceProductionTime = (int)readline("Enter juice production time (minutes per fruit): ");
        $resources = (int)readline("Enter total resources available: ");


        $automation = new FruitAutomationService(
            $fruits,
            $transportTime,
            $sortingTime,
            $juiceProductionTime,
            $resources);

        $result = $automation->runAutomation();

        self::writeConsole("Total time: " . ($result['totalTime'] / 60) . " hours");
        self::writeConsole("Total time of fruit picking: " . $result['harvestingTime'] . " minutes.");
        self::writeConsole("Total time of fruit sortTime: " . $result['sortTime'] . " minutes.");
        self::writeConsole("Total juice produced: " . $result['totalJuiceProduced'] . " units");
    }

    /**
     * Writes a message to the console with optional color formatting.
     *
     * @param string $str The message to write.
     * @param string $type The type of message ('e' for error, 's' for success, 'w' for warning, default for information).
     * @return void
     */
    final static function writeConsole(string $str, string $type = 'i'): void
    {
        // Use color formatting based on the specified type
        echo match ($type) {
            'e' => "\033[31m$str \033[0m\n",
            's' => "\033[32m$str \033[0m\n",
            'w' => "\033[33m$str \033[0m\n",
            default => "\033[36m$str \033[0m\n",
        };
    }
}


