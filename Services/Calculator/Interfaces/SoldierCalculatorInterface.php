<?php

namespace Services\Calculator\Interfaces;


interface SoldierCalculatorInterface
{
    /**
     * @param float $health
     * @param int $experience
     * @return float
     */
    public function getAttackProbability(float $health, int $experience): float;

    /**
     * @param int $experience
     * @return float
     */
    public function getDamage(int $experience): float;

}