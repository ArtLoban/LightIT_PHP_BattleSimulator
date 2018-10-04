<?php

namespace Services\Calculator;

use Services\Calculator\Interfaces\SoldierCalculatorInterface;

class SoldierCalculator implements SoldierCalculatorInterface
{
    /**
     * @param float $health
     * @param int $experience
     * @return float
     */
    public function getAttackProbability(float $health, int $experience): float
    {
        $value = 0.5 * (1 + $health / 100) * mt_rand(50 + $experience, 100) / 100;
        return round($value, 3);
    }

    /**
     * @param int $experience
     * @return float
     */
    public function getDamage(int $experience): float
    {
        $value = 0.05 + $experience / 100;
        return round($value, 2);
    }


}