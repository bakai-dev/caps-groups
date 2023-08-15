<?php

declare(strict_types=1);

use App\Entity\Fruit;

use App\Exception\FruitGardenAutomationException;
use App\Service\FruitAutomationService;
use PHPUnit\Framework\TestCase;
use Faker\Factory;

final class FruitGardenAutomationTest extends TestCase
{
    /**
     * Creating an object for automation | Test
     *
     * @test
     * @return void
     * @throws FruitGardenAutomationException
     */
    public function testTotalTimeAndJuiceProduced(): void
    {
        $faker = Factory::create();

        // Create random fruit objects with Faker
        $apple = new Fruit($faker->word, $faker->numberBetween(1, 10), $faker->numberBetween(1, 10));
        $orange = new Fruit($faker->word, $faker->numberBetween(1, 10), $faker->numberBetween(1, 10));

        $fruits = [$apple, $orange];

        // Create random parameters for the other parameters
        $transportTime = $faker->numberBetween(1, 10);
        $sortingTime = $faker->numberBetween(1, 10);
        $juiceProductionTime = $faker->numberBetween(1, 10);
        $resources = $faker->numberBetween(1, 10);

        // Creating an object for automation
        $automation = new FruitAutomationService($fruits, $transportTime, $sortingTime, $juiceProductionTime, $resources);

        //Run the automation and output the results
        $result = $automation->runAutomation();

        // Check that the results are numbers
        $this->assertIsNumeric($result['totalTime']);
        $this->assertIsNumeric($result['totalJuiceProduced']);
    }
}
