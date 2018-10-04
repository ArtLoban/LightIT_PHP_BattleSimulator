<?php

namespace Services\Calculator;

use Services\Calculator\Interfaces\SquadCalculatorInterface;

class SquadCalculator implements SquadCalculatorInterface
{
    /**
     * @param array $units
     * @return float
     */
    public function getAttackProbability(array $units): float
    {
        $mult = 1;
        foreach ($units as $unit) {
            $mult *= $unit->calculateAttackProbability();
        }
        $value = pow($mult, 1 / count($units));

        return round($value, 3);
    }

    /**
     * @param array $units
     * @return float
     */
    public function getDamage(array $units): float
    {
        $sum = 0;
        foreach ($units as $unit) {
            $sum += $unit->calculateDamage();
        }

        return round($sum, 2);
    }

}