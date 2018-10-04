<?php

namespace Services\Calculator\Interfaces;


interface SquadCalculatorInterface
{
    /**
     * @param array $units
     * @return float
     */
    public function getAttackProbability(array $units): float;

    /**
     * @param array $units
     * @return float
     */
    public function getDamage(array $units): float;

}