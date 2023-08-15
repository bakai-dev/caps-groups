<?php

declare(strict_types=1);

namespace App\Service;

use App\Exception\FruitGardenAutomationException;

/**
 * Class FruitAutomationService
 * @package App\Service
 */
final class FruitAutomationService
{
    private array $fruits;
    private int $transportTime;
    private int $sortingTime;
    private int $juiceProductionTime;
    private int $resources;

    /**
     * @param array $fruits
     * @param int $transportTime
     * @param int $sortingTime
     * @param int $juiceProductionTime
     * @param int $resources
     */
    public function __construct(array $fruits, int $transportTime, int $sortingTime, int $juiceProductionTime, int $resources)
    {
        $this->juiceProductionTime = $juiceProductionTime;
        $this->transportTime = $transportTime;
        $this->sortingTime = $sortingTime;
        $this->resources = $resources;
        $this->fruits = $fruits;
    }

    /**
     * Runs the automation process for fruit collection, sorting, and juice production.
     *
     * @return array An array containing the total time, total juice produced, sort time, and total harvesting time.
     * @throws FruitGardenAutomationException
     */
    public function runAutomation(): array
    {
        $totalJuiceProduced = 0;
        $harvestingTime = 0;
        $totalTime = 0;
        $sortTime = 0;

        foreach ($this->fruits as $fruit) {
            $ripeningTime = $fruit->getRipeningTime();
            $harvestingTime = $fruit->getHarvestingTime();
            $fruitAmount = $this->resources / $harvestingTime;

            // Simulate waiting
            sleep(1);

            $this->collectFruits($fruit->getName(), $fruitAmount);
            $this->transportFruits($fruit->getName(), $fruitAmount);
            $this->sortFruits($fruit->getName(), $fruitAmount);
            $this->produceJuice($fruit->getName(), $fruitAmount);
            $harvestingTime += $harvestingTime;
            $sortTime += $this->sortingTime;
            $totalJuiceProduced += $fruitAmount;
            $totalTime += $ripeningTime + $harvestingTime + $this->transportTime + $this->sortingTime + $this->juiceProductionTime;
        }

        return compact('totalTime', 'totalJuiceProduced', 'sortTime', 'harvestingTime');
    }

    /**
     * Collects the specified amount of the given fruit.
     *
     * @param string $fruit The type of fruit to collect.
     * @param int | float $amount The amount of fruit to collect.
     * @return void
     * @throws FruitGardenAutomationException If the specified fruit type is invalid.
     */
    private function collectFruits(string $fruit, int|float $amount): void
    {
        $foundFruit = null;

        foreach ($this->fruits as $availableFruit) {
            if ($availableFruit->getName() === $fruit) {
                $foundFruit = $availableFruit;
                break;
            }
        }

        if ($foundFruit === null) {
            throw new FruitGardenAutomationException("Invalid fruit type: $fruit");
        }

        $timeTaken = $foundFruit->getHarvestingTime() * $amount;
        echo "Collecting $amount {$foundFruit->getName()}. Time taken: $timeTaken minutes." . PHP_EOL;
    }

    /**
     * Transports the specified amount of fruits to the sorting area.
     *
     * @param string $fruit The type of fruit to transport.
     * @param int | float $amount The amount of fruit to transport.
     * @return void
     */
    private function transportFruits(string $fruit, int|float $amount): void
    {
        echo "Transporting $amount $fruit to sorting. Time taken: $this->transportTime minutes." . PHP_EOL;
    }

    /**
     * Sorts the specified amount of fruits.
     *
     * @param string $fruit The type of fruit to sort.
     * @param int | float $amount The amount of fruit to sort.
     * @return void
     */
    private function sortFruits(string $fruit, int|float $amount): void
    {
        echo "Sorting $amount $fruit. Time taken: $this->sortingTime minutes." . PHP_EOL;
    }

    /**
     * Produces juice from the specified amount of the given fruit.
     *
     * @param string $fruit The type of fruit to produce juice from.
     * @param int | float $amount The amount of fruit to produce juice from.
     * @return void
     */
    private function produceJuice(string $fruit, int|float $amount): void
    {
        echo "Producing juice from $amount $fruit. Time taken: $this->juiceProductionTime minutes." . PHP_EOL;
    }

}
