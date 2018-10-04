<?php

namespace Services\Calculator;

use Services\Calculator\Interfaces\VehicleCalculatorInterface;

class VehicleCalculator implements VehicleCalculatorInterface
{
    /**
     * @param float $health
     * @param array $units
     * @return float
     */
    public function getAttackProbability(float $health, array $units): float
    {
        $value = 0.5 * (1 + $health / 100) * $this->geometricAverage($units);

        return round($value, 3);
    }

    /**
     * @param array $units
     * @return float
     */
    public function getDamage(array $units): float
    {
        $sumExperience = 0;
        foreach ($units as $unit) {
            $sumExperience += $unit->getExperience();
        }
        $value = 0.1 + ($sumExperience / 100);

        return round($value, 2);
    }

    /**
     * Calculate geometric average of attack probability of all composed Units
     *
     * @param array $units
     * @return float
     */
    private function geometricAverage(array $units): float
    {
        $mult = 1;
        foreach ($units as $unit) {
            $mult *= $unit->calculateAttackProbability();
        }
        $gavg = pow($mult, 1 / count($units));

        return round($gavg, 3);
    }
}
