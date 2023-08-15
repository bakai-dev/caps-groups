<?php

declare(strict_types=1);

namespace App\Entity;

/**
 * Class Fruit
 * @package App\Entity
 */
class Fruit
{
    private string $name;
    private int $ripeningTime;
    private int $harvestingTime;

    /**
     * @param string $name
     * @param int $ripeningTime
     * @param int $harvestingTime
     */
    public function __construct(string $name, int $ripeningTime, int $harvestingTime)
    {
        $this->name = $name;
        $this->ripeningTime = $ripeningTime;
        $this->harvestingTime = $harvestingTime;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getRipeningTime(): int|float
    {
        return $this->ripeningTime;
    }

    public function getHarvestingTime(): int|float
    {
        return $this->harvestingTime;
    }
}
