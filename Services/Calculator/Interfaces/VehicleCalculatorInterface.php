<?php

namespace Services\Calculator\Interfaces;

interface VehicleCalculatorInterface
{
    /**
     * @param float $health
     * @param array $units
     * @return float
     */
    public function getAttackProbability(float $health, array $units): float;

    /**
     * @param array $units
     * @return float
     */
    public function getDamage(array $units): float;
}
